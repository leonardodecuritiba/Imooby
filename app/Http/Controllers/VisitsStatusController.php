<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitsStatusRequest;
use App\Models\Visit;
use App\Models\VisitsStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class VisitsStatusController extends Controller
{
    private $name = 'Status de Visitas';
    private $Page;

    public function __construct()
    {
        $this->Page = (object)[
            'table' => "visits",
            'link' => "visits_status",
            'Target' => "Status de Visitas",
            'Targets' => "Status de Visitas",
            'Titulo' => "Status de Visitas",
            'tab' => "",
            'Sex' => "M",
            'titulo_primario' => "",
            'titulo_secundario' => "",
        ];
    }

    public function index()
    {
        $Buscas = VisitsStatus::all();
        return view('admin.pages.status_config.index')
            ->with('Page', $this->Page)
            ->with('Buscas', $Buscas);
    }

    public function update(VisitsStatusRequest $request, $id)
    {
        $Data = VisitsStatus::findOrFail($id);
        $Data->update($request->all());
        session()->forget('mensagem');
        session(['mensagem' => trans('messages.crud.' . $this->Page->Sex . 'US', ['name' => $this->name])]);
        return Redirect::route('visits_status.index');
    }

}
