<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusNegociationsRequest;
use App\Models\Negociations\StatusNegociation;
use Illuminate\Support\Facades\Redirect;

class StatusNegociationsController extends Controller
{
    private $name = 'Status de Negociações';
    private $Page;

    public function __construct()
    {
        $this->Page = (object)[
            'table' => "status_negociations",
            'link' => "status_negociations",
            'Target' => "Status de Negociações",
            'Targets' => "Status de Negociações",
            'Titulo' => "Status de Negociações",
            'tab' => "",
            'Sex' => "M",
            'titulo_primario' => "",
            'titulo_secundario' => "",
        ];
    }

    public function index()
    {
        $Buscas = StatusNegociation::all();
        return view('admin.pages.status_config.index')
            ->with('Page', $this->Page)
            ->with('Buscas', $Buscas);
    }

    public function update(StatusNegociationsRequest $request, $id)
    {
        $Data = StatusNegociation::findOrFail($id);
        $Data->update($request->all());
        session()->forget('mensagem');
        session(['mensagem' => trans('messages.crud.' . $this->Page->Sex . 'US', ['name' => $this->name])]);
        return Redirect::route('status_negociations.index');
    }

}
