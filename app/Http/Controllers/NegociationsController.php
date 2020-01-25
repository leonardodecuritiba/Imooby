<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Http\Requests\Negociation\NegociationAcceptOwnerConditionsRequest;
use App\Http\Requests\Negociation\NegociationAcceptRenterConditionsRequest;
use App\Http\Requests\Negociation\NegociationAcceptRenterProposeRequest;
use App\Http\Requests\Negociation\NegociationSubmitOwnerDocumentsRequest;
use App\Http\Requests\Negociation\NegociationSubmitRenterDocumentsRequest;
use App\Http\Requests\Negociation\NegociationSubmitRenterProposeRequest;
use App\Http\Requests\Negociation\NegociationOpenRequest;
use App\Models\Negociations\Negociation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class NegociationsController extends Controller
{
    function __construct()
    {
//        if((!Auth::check()) || (Auth::user()->client == NULL)) return abort(404);
    }

    //Passo 1
    public function open(NegociationOpenRequest $request)
    {
        $data = $request->all();
        $data['idrenter'] = Auth::user()->client->id;
        $Negociation = Negociation::open($data);
        session(['status' => 'Negociação Aberta com sucesso!']);
        return Redirect::route('negociation.show', $Negociation->id);
    }

    public function acceptRenterConditions(NegociationAcceptRenterConditionsRequest $request, $id)
    {
        $Negociation = Negociation::findOrFail($id);
        return $Negociation->acceptRenterConditions();
    }

    public function submitRenterPropose(NegociationSubmitRenterProposeRequest $request, $id)
    {
        $Negociation = Negociation::findOrFail($id);
        return $Negociation->submitRenterPropose($request->all());
    }

    public function acceptRenterPropose($id)
    {
        $Negociation = Negociation::findOrFail($id);
        return $Negociation->acceptRenterPropose();
    }

    public function acceptOwnerConditions(NegociationAcceptOwnerConditionsRequest $request, $id)
    {
        $Negociation = Negociation::findOrFail($id);
        return $Negociation->acceptOwnerConditions();
    }

    public function submitOwnerDocuments(NegociationSubmitOwnerDocumentsRequest $request, $id)
    {
        $Negociation = Negociation::findOrFail($id);
        //has_owner_document
        if ($Negociation->owner_document != NULL) {
            $message = 'Seus documentos já foram recebidos! Aguarde a aprovação!';
            session(['error' => $message]);
        } else {
            $data = $request->all();
            $ImageHelper = new ImageHelper();
            $data['idnegociation']      = $id;
            $data['doc_link']           = $ImageHelper->store($request->file('doc_link'), 'negociations');
            $data['cpf_link']           = $ImageHelper->store($request->file('cpf_link'), 'negociations');
            $data['address_proof_link'] = $ImageHelper->store($request->file('address_proof_link'), 'negociations');
            $message = $Negociation->submitOwnerDocuments($data);
            session(['status' => $message]);
        }

        return Redirect::route('negociation.show', $id);
    }

    public function submitRenterDocuments(NegociationSubmitRenterDocumentsRequest $request, $id)
    {
        $Negociation = Negociation::findOrFail($id);
        if($Negociation->renter_documents->count() > 0){
            $message = 'Seus documentos já foram recebidos! Aguarde a aprovação!';
            session(['status' => $message]);
        } else {
            $data = $request->all();
            $ImageHelper = new ImageHelper();
            foreach($data['document'] as $i => $document){
                $data['document'][$i]['idnegociation']      = $id;
                $data['document'][$i]['doc_link']           = $ImageHelper->store(Request::file('document')[$i]['doc_link'], 'negociations');
                $data['document'][$i]['cpf_link']           = $ImageHelper->store(Request::file('document')[$i]['cpf_link'], 'negociations');
                $data['document'][$i]['address_proof_link'] = $ImageHelper->store(Request::file('document')[$i]['address_proof_link'], 'negociations');
                $data['document'][$i]['income_proof_link']  = $ImageHelper->store(Request::file('document')[$i]['income_proof_link'], 'negociations');
            }
            $message = $Negociation->submitRenterDocuments($data);
            session(['status' => $message]);
        }
        return Redirect::route('negociation.show', $id);
    }
    
    public function verifySignature($id)
    {
        if ($negotiation = Negociation::find($id)) {
            $negotiation->verifySignature();
        }
    }
}
