@extends('layouts.app')

@section('css')
    @parent
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center col-md-12">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Liste Operation</div>
                    
                    <div class="card-body">
                        <fieldset  class="border-top border-right border-left border p-2">
                            <div class="row">
                            <div  class="col-md-6">
                                <span class="float-start">Total Caisse : {{ $totals }} €</span>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-primary col-md-4 float-end" onclick="showOperationForm()">Nouvelle operation</button>
                            </div>
                        </div>
                        </fieldset>
                        <table class="table table-striped">
                            <thead>
                            <th class="center col-lg-2">Date</th>
                            <th class="center col-lg-2">Type</th>
                            <th class="center col-lg-2">Retrait</th>
                            <th class="center col-lg-2">Ajouts</th>
                            <th class="center col-lg-2">Total</th>
                            <th class="center col-lg-2">Actions</th>
                            </thead>
                            <tbody id="tbodyAjoutOp">
                            @foreach ($operations as $operation)
                                <tr id="trAjoutOp-1">
                                    <td>{{ date('d/m/Y', strtotime($operation->date)) }}</td>
                                    <td>{{ $operation->type }}</td>
                                    <td>{{ $operation->montant_retrait }}</td>
                                    <td>{{ $operation->montant_depot }}</td>
                                    <td>{{ $operation->montant_depot - $operation->montant_retrait }}</td>
                                    <td>
                                        <button class="btn">
                                            <span class="fa fa-pencil" onclick="showOperationEdithForm()"></span>
                                        </button>
                                        <button class="btn">
                                            <span class="fa fa-trash" onclick="showModalDeleteConfirm('{{ $operation->id }}')"></span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@include('popupAjoutOperation')
@include('popupConfirmDeleteOperation')
@include('popupEdithOperation')
@endsection
@section('js')
    @parent
    <script>
    </script>
@endsection

