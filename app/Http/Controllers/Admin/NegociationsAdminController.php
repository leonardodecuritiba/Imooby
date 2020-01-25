<?php

namespace App\Http\Controllers\Admin;

use App\Models\Negociations\Negociation;
use App\Models\Negociations\NegociationDocument;
use Illuminate\Support\Facades\Redirect;

class NegociationsAdminController extends AdminController
{
    private $name = 'Negociações';
    private $Page;

    public function __construct()
    {
        $this->Page = (object)[
            'table' => "negociations",
            'link' => "negociations",
            'Target' => "Negociação",
            'Targets' => "Negociações",
            'Titulo' => "Negociação",
            'tab' => "",
            'Sex' => "M",
            'titulo_primario' => "",
            'titulo_secundario' => "",
        ];
    }

    public function index()
    {
        $Buscas = Negociation::with(['property', 'property.owner', 'renter'])->get();
        return view('admin.pages.' . $this->Page->link . '.index')
            ->with('Page', $this->Page)
            ->with('Buscas', $Buscas);
    }

    public function show($id)
    {
        $Data = Negociation::findOrFail($id);
        return view('admin.pages.' . $this->Page->link . '.show')
            ->with('Data', $Data)
            ->with('Page', $this->Page);
    }

    public function acceptDocument($id)
    {
        $Data = NegociationDocument::findOrFail($id);
        $message = $Data->acceptDocument();
        session()->forget('mensagem');
        session(['mensagem' => $message]);
        return Redirect::route('negociations.show', $Data->idnegociation);
    }

    public function rejectDocument($id)
    {
        $Data = NegociationDocument::findOrFail($id);
        $message = $Data->rejectDocument();
        session()->forget('mensagem');
        session(['mensagem' => $message]);
        return Redirect::route('negociations.show', $Data->idnegociation);
    }

    public function acceptAdminOwnerDocument($id)
    {
        $Negociation = Negociation::findOrFail($id);
        $message = $Negociation->acceptAdminOwnerDocument();
        session()->forget('mensagem');
        session(['mensagem' => $message]);
        return Redirect::route('negociations.show', $id);
    }

    public function rejectAdminOwnerDocument($id)
    {
        $Negociation = Negociation::findOrFail($id);
        $message = $Negociation->rejectAdminOwnerDocument();
        session()->forget('mensagem');
        session(['mensagem' => $message]);
        return Redirect::route('negociations.show', $id);
    }

    public function acceptAdminRenterDocuments($id)
    {
        $Negociation = Negociation::findOrFail($id);
        $message = $Negociation->acceptAdminRenterDocuments();
        session()->forget('mensagem');
        session(['mensagem' => $message]);
        return Redirect::route('negociations.show', $id);
    }

    public function rejectAdminRenterDocuments($id)
    {
        $Negociation = Negociation::findOrFail($id);
        $message = $Negociation->rejectAdminRenterDocuments();
        session()->forget('mensagem');
        session(['mensagem' => $message]);
        return Redirect::route('negociations.show', $id);
    }


//    public function destroy($id)
//    {
//        $data = Visit::findOrFail($id);
//        $data->user->delete();
//        $data->photo->delete();
//        $data->delete();
//        return response()->json(['status' => '1',
//            'response' => trans('messages.crud.' . $this->Page->Sex . 'DS', ['name' => $this->name])]);
//    }

}
