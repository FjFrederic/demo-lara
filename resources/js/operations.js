const axios = require('axios');
$(document).ready(function() {
    delete_block();
    $('.add-form-billet').on('click', function(){
        var formAddBillet = '<div class="block-billetage row">'+
            '<div class="form-group col-3">'+
            '<label for="nominalBillets" class="control-label">Nominal</label>'+
            '<select name="nominalBillets[]" id="nominalBillets" class="form-control nominalBillets">'+
            '<option value="0"></option>'+
            '<option value="5">5</option>'+
            '<option value="10">10</option>'+
            '<option value="20">20</option>'+
            '<option value="50">50</option>'+
            '<option value="100">100</option>'+
            '<option value="200">200</option>'+
            '<option value="500">500</option>'+
            '</select>'+
            '</div>'+
            '<div class="form-group col-3">'+
            '<label for="quantiteBillets" class="control-label">Quantite</label>'+
            '<input type="number" name="quantiteBillets[]" id="quantiteBillets" class="form-control quantiteBillets" />'+
            '</div>'+
            '<div class="form-group col-1">'+
            '<button type="button" class="delete-form btn btn-default" id="delete-for"><span class="fa fa-minus-square"></span></button>'+
            '</div>'+
            '<div class="col-4"></div>'+
            '<div class="form-group col-1"><span class="montantbillets">0</span>€</div>'+
            '</div>';
        $('.billets').append(formAddBillet);
        delete_block();
        calcul_billets();
    });

    $('.add-form-piece').on('click', function(){
        var formAddPieces = '<div class="block-billetage row">'+
            '<div class="form-group col-3">'+
            '<label for="nominalBillets" class="control-label">Nominal</label>'+
            '<select name="nominalPieces[]" id="nominalBillets" class="form-control nominalBillets">'+
                '<option value="0"></option>'+
                '<option value="1">1</option>'+
                '<option value="2">2</option>'+
            '</select>'+
            '</div>'+
            '<div class="form-group col-3">'+
            '<label for="quantiteBillets" class="control-label">Quantite</label>'+
            '<input type="number" name="quantitePieces[]" id="quantiteBillets" class="form-control col-lg-3 quantiteBillets" />'+
            '</div>'+
            '<div class="col-1">'+
            '<button type="button" class="delete-form btn btn-default"><span class="fa fa-minus-square"></span></button>'+
            '</div>'+
            '<div class="col-4"></div>'+
            '<div class="col-1"><span class="montantbillets">0</span>€</div>'+
            '</div>';
        $('.pieces').append(formAddPieces);
        delete_block();
        calcul_billets();
    });

    $('.add-form-centime').on('click', function(){
        var formAddCentimes = '<div class="block-billetage row">'+
            '<div class="form-group col-3">'+
            '<label for="nominalBillets" class="control-label">Nominal</label>'+
            '<select name="nominalCentimes[]" id="nominalBillets" class="form-control nominalBillets">'+
                '<option value="0"></option>'+
                '<option value="50">50</option>'+
                '<option value="20">20</option>'+
                '<option value="10">10</option>'+
                '<option value="5">5</option>'+
                '<option value="2">2</option>'+
                '<option value="1">1</option>'+
            '</select>'+
            '</div>'+
            '<div class="form-group col-3">'+
            '<label for="quantiteBillets" class="control-label">Quantite</label>'+
            '<input type="number" name="quantiteCentimes[]" id="quantiteBillets" class="form-control quantiteBillets" />'+
            '</div>'+
            '<div class="col-1">'+
            '<button type="button" class="delete-form btn btn-default"><span class="fa fa-minus-square"></span></button>'+
            '</div>'+
            '<div class="col-4"></div>'+
            '<div class="col-1"><span class="montantbillets">0</span>€</div>'+
            '</div>';
        $('.centimes').append(formAddCentimes);
        delete_block();
        calcul_billets();
    });

    $("#modalAjoutOperation .close").on('click', function(){
        $("#modalAjoutOperation").modal('hide');
    });

    $("#modalAjoutOperation .add-operation").on('click', function(){
        window.localStorage.removeItem('totalMontant');
   });

    $("#modalDeleteConfirm .close").on('click', function(){
        $("#modalDeleteConfirm").modal('hide');
    });

    $("#modalEdithOperation .close").on('click', function(){
        $("#modalEdithOperation").modal('hide');
    });

    calcul_billets();
});

showOperationForm = function () {
    $('#modalAjoutOperation').modal('show');
}

showOperationEdithForm = function () {
    $('#modalEdithOperation').modal('show');
}

showModalDeleteConfirm = function (operationId) {
    $('#modalDeleteConfirm').modal('show');

    $(".btn-confirm-delete").on('click', function(){
        axios.delete(`/deleteOperation/${operationId}`).then((response)=>{
            window.location = "/home";
        })
    });

}

delete_block = function () {
    $('.delete-form').on('click', function(){
        var my_group = this;
        var oldMontant = parseFloat($('.totalMontant').text());
        $(my_group).each(function(){
            $parent = $(this).parents('.block-billetage');
            var montantDeleted = parseFloat($parent.find('.montantbillets').text());
            const OldTotalMontant = localStorage.getItem('totalMontant');
            var totalMontant = OldTotalMontant - montantDeleted;
            localStorage.setItem('totalMontant', totalMontant);
            $('.totalMontant').html(localStorage.getItem('totalMontant'));
            $(this).parents('.block-billetage').remove();
        });
    });
}

calcul_billets = function() {
    $(".nominalBillets").on('change', function(){
        var my_group = this;
        $(my_group).each(function(){
            $parent = $(this).parents('.block-billetage');
            const quantiteBilletsValue = parseFloat($parent.find('.quantiteBillets').val());
            if (quantiteBilletsValue) {
                const nominalBilletsValue = parseFloat($(this).val());
                  //convertion cents en euro
                if ($parent.find("select[name='nominalCentimes[]']").length > 0) {
                    nominalBilletsValue = nominalBilletsValue / 100;
                }
                const montantQuantite = parseFloat(nominalBilletsValue) * parseFloat(quantiteBilletsValue);
                const totalMontant = localStorage.getItem('totalMontant');
                if (totalMontant === null) {
                    localStorage.setItem('totalMontant', parseFloat(montantQuantite));
                } else {
                    const OldTotalMontant = parseFloat(localStorage.getItem('totalMontant'));
                    localStorage.setItem('totalMontant', (OldTotalMontant + montantQuantite).toPrecision(2));
                }
                $parent.find('.montantbillets').text(montantQuantite.toPrecision(2).replace(/(\.0+|0+)$/, ''));
                $('.totalMontant').html(localStorage.getItem('totalMontant'));
            }
        });
    });

    $(".quantiteBillets").on('keyup, change', function(){
        var my_group = this;
        $(my_group).each(function(){
            $parent = $(this).parents('.block-billetage');
            const nominalBilletsValue = parseFloat($parent.find('.nominalBillets').val());
            if (nominalBilletsValue) {
                //convertion cents en euro
                if ($parent.find("select[name='nominalCentimes[]']").length > 0) {
                    nominalBilletsValue = nominalBilletsValue / 100;
                }
                const montantBillets = parseFloat($(this).val()) * parseFloat(nominalBilletsValue);
                const totalMontant = localStorage.getItem('totalMontant');
                if (totalMontant === null) {
                    localStorage.setItem('totalMontant', parseFloat(montantBillets));
                } else {
                    const OldTotalMontant = parseFloat(localStorage.getItem('totalMontant'));
                    localStorage.setItem('totalMontant', (OldTotalMontant + montantBillets).toPrecision(2));
                }
                $parent.find('.montantbillets').text(montantBillets.toPrecision(2).replace(/(\.0)$/, ''));
                $('.totalMontant').html(localStorage.getItem('totalMontant'));
            }
        });
    });
}
