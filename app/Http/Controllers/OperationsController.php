<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOperationRequest;
use App\Models\Operation;
use App\Models\Billetage;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\DB;

class OperationsController extends Controller
{
    public function index()
    {
        $operations = Operation::select(
            'id',
            'date',
            'type',
            'montant_depot',
            'montant_retrait'
        )
            ->orderBy('date', 'ASC')
            ->get();

        $totalDepot = 0;
        $totalRetrait = 0;
        foreach ($operations as $operation) {
            $totalDepot+= $operation->montant_depot;
            $totalRetrait+= $operation->montant_retrait;
        }

        $total = $totalDepot - $totalRetrait;

        return view('operations', [
            'operations' => $operations,
            'totals' => $total
        ]);
    }

    public function ajoutOperation(CreateOperationRequest $request)
    {
        $dataBilletages = [];
        $montantTotaux = 0;
        if(isset($request->nominalBillets)) {
            $sizeNominalBillets = sizeof($request->nominalBillets);
            for($i = 0; $i < $sizeNominalBillets; $i++) {
                $rowFormBillet = [];
                $rowFormBillet['type_monnaie'] = Billetage::BILLETS;
                if(isset($request->nominalBillets[$i]) &&
                    !empty($request->nominalBillets[$i]) &&
                    isset($request->quantiteBillets[$i]) &&
                    !empty($request->quantiteBillets[$i])
                ){
                    $rowFormBillet['nominalBillets'] = $request->nominalBillets[$i];
                    $rowFormBillet['quantiteBillets'] = $request->quantiteBillets[$i];
                    $rowFormBillet['montantBillets'] = $request->nominalBillets[$i] * $request->quantiteBillets[$i];
                    $montantTotaux += $rowFormBillet['montantBillets'];
                    array_push($dataBilletages, $rowFormBillet);
                }

            }
        }

        if(isset($request->nominalPieces)) {
            $sizeNominalPieces = sizeof($request->nominalPieces);
            for($i = 0; $i < $sizeNominalPieces; $i++) {
                $rowFormPieces = [];
                $rowFormPieces['type_monnaie'] = Billetage::PIECES;
                if(isset($request->nominalPieces[$i]) &&
                    !empty($request->nominalPieces[$i]) &&
                    isset($request->quantitePieces[$i]) &&
                    !empty($request->quantitePieces[$i])
                ){
                    $rowFormPieces['nominalBillets'] = $request->nominalPieces[$i];
                    $rowFormPieces['quantiteBillets'] = $request->quantitePieces[$i];
                    $rowFormPieces['montantBillets'] = $request->nominalPieces[$i] * $request->quantitePieces[$i];
                    $montantTotaux += $rowFormPieces['montantBillets'];
                    array_push($dataBilletages, $rowFormPieces);
                }

            }
        }

        if(isset($request->nominalCentimes)) {
            $sizeNominalCentimes = sizeof($request->nominalCentimes);
            for($i = 0; $i < $sizeNominalCentimes; $i++) {
                $rowFormCentimes = [];
                $rowFormCentimes['type_monnaie'] = Billetage::CENTIMES;
                if(isset($request->nominalCentimes[$i]) &&
                    !empty($request->nominalCentimes[$i]) &&
                    isset($request->quantiteCentimes[$i]) &&
                    !empty($request->quantiteCentimes[$i])
                ){
                    $rowFormCentimes['nominalBillets'] = $request->nominalCentimes[$i];
                    $rowFormCentimes['quantiteBillets'] = $request->quantiteCentimes[$i];
                    $rowFormCentimes['montantBillets'] = round($request->nominalCentimes[$i] / 100, 2) * $request->quantiteCentimes[$i];
                    $montantTotaux += $rowFormCentimes['montantBillets'];
                    array_push($dataBilletages, $rowFormCentimes);
                }
            }
        }


        $operation = new Operation();
        $operation->type = $request->typeOperation;
        $operation->date = $request->dateOperation;
        $operation->commentaire = $request->commentaire;

        if ($request->typeOperation == Operation::DEPOT) {
            $operation->montant_depot = $montantTotaux;
        } else {
            $operation->montant_retrait = $montantTotaux;
        }

        $operation->save();

        foreach ($dataBilletages as $dataBilletage) {
            $billetage = new Billetage();
            $billetage->nominal = intVal($dataBilletage['nominalBillets']);
            $billetage->quantite = intVal($dataBilletage['quantiteBillets']);
            $billetage->montant = floatval($dataBilletage['montantBillets']);
            $billetage->type_monnaie = $dataBilletage['type_monnaie'];
            $billetage->operation_id = $operation->id;
            $billetage->save();
        }

        return redirect('/home');
    }

    public function deleteOperation($idOperation)
    {
        $operation = Operation::find($idOperation);
        $operation->delete();
        return response()->json($operation, '200');
    }
}
