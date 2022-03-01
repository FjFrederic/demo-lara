
<div class="modal fade in operation" id="modalEdithOperation" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
                <h4> Modification operation  <span style="color: red">[ Fonctionnalité en cours de developpement]</span></h4>
				<button type="button" class="close" data-dismiss="modal" >
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

            <form id="formEdithOperation" class="form-horizontal" action="/home" method="get">
                @csrf
			    <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="row">
                            <h4> Entrée de font de caisse</h4>
                            <div class="form-group">
                                <label for="type-operation" class="col-lg-2 control-label">Type d'opération</label>
                                <div class="col-lg-5">
                                    <select name="typeOperation" class="form-control">
                                        <option value="">--- Séléctionner le type ---</option>
                                        <option value="depot">dêpot de caise</option>
                                        <option value="remise">remise de banque</option>
                                        <option value="retrait">retrait de caise</option>
                                    </select>
                                </div>
                                <div id="totalMontant"><span class="totalMontant">0</span> €</div>
                            </div>
                            <div class="form-group">
                                <label for="dateOperation" class="col-lg-2 control-label">Date</label>
                                <div class="col-lg-5">
                                    <input
                                            type="date"
                                            name="dateOperation"
                                            class="form-control"
                                    />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="commentaire" class="col-lg-2 control-label">Note</label>
                                <div class="col-lg-12">
                                    <textarea
                                            type="text"
                                            name="commentaire"
                                            title="Le Code Banque doit faire 5 caractères."
                                            class="form-control"
                                    ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h4 class="block-1">Billets</h4>
                            <div class="billets">
                                <div class="block-billetage row">
                                    <div class="form-group col-3">
                                        <label for="nominalBillets" class="control-label">Nominal</label>
                                        <select name="nominalBillets[]" id="nominalBillets" class="form-control nominalBillets">
                                            <option value="0"></option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                            <option value="200">200</option>
                                            <option value="500">500</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="quantiteBillets" class="control-label">Quantite</label>
                                        <input
                                            type="number"
                                            name="quantiteBillets[]"
                                            id="quantiteBillets"
                                            class="form-control quantiteBillets"
                                        />
                                    </div>
                                    <div class="form-group col-1">
                                        <button type="button" class="delete-form btn btn-default" id="delete-for"><span class="fa fa-minus-square"></span></button>
                                    </div>
                                    <div class="col-4"></div>
                                    <div class="form-group col-1 montant-block-1"><span class="montantbillets">0</span> €</div>
                                </div>
                            </div>
                            <div class="col-2 btn-add-form">
                                <button type="button" class="btn add-form-billet btn-primary">Ajouter</button>
                            </div>
                        </div>
                        <div class="row">
                            <h4 class="block-2">Pièces</h4>
                            <div class="pieces">
                                <div class="block-billetage row">
                                    <div class="form-group col-3">
                                        <label for="nominalBillets" class="control-label">Nominal</label>
                                        <select name="nominalPieces[]" id="nominalBillets" class="form-control nominalBillets">
                                            <option value="0"></option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="quantiteBillets" class="control-label">Quantite</label>
                                        <input
                                            type="number"
                                            name="quantitePieces[]"
                                            id="quantiteBillets"
                                            class="form-control col-lg-3 quantiteBillets"
                                        />
                                    </div>
                                    <div class="col-1">
                                        <button type="button" class="delete-form btn btn-default"><span class="fa fa-minus-square"></span></button>
                                    </div>
                                    <div class="col-4"></div>
                                    <div class="form-group col-1 montant-block-2"><span class="montantbillets">0</span> €</div>
                                </div>
                            </div>
                            <div class="col-2 btn-add-form">
                                <button type="button" class="btn btn-primary add-form-piece">Ajouter</button>
                            </div>
                        </div>
                        <div class="row">
                            <h4  class="block-3">Centimes</h4>
                            <div class="centimes">
                                <div class="block-billetage row">
                                    <div class="form-group col-3">
                                        <label for="nominalBillets" class="control-label">Nominal</label>
                                        <select name="nominalCentimes[]" id="nominalBillets" class="form-control nominalBillets">
                                            <option value="0"></option>
                                            <option value="50">50</option>
                                            <option value="20">20</option>
                                            <option value="10">10</option>
                                            <option value="5">5</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="quantiteBillets" class="control-label">Quantite</label>
                                        <input
                                            type="number"
                                            name="quantiteCentimes[]"
                                            id="quantiteBillets"
                                            class="form-control quantiteBillets"
                                        />
                                    </div>
                                    <div class="col-1">
                                        <button type="button" class="delete-form btn btn-default"><span class="fa fa-minus-square"></span></button>
                                    </div>
                                    <div class="col-4"></div>
                                    <div class="form-group col-1 montant-block-3"><span class="montantbillets">0</span> €</div>
                                </div>
                            </div>
                            <div class="col-2 btn-add-form">
                                <button type="button" class="btn btn-primary add-form-centime">Ajouter</button>
                            </div>
                        </div>
                    </div>
			    </div>
                <div id="popaff-footer" class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-secondary" > Modifier</button>
                </div>
            </form>
		</div>

	</div>
</div>
@error('typeOperation')
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror
