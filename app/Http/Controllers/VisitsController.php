<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\VisitsStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class VisitsController extends Controller
{
    private $name = 'Visitas';
    private $Page;

    public function __construct()
    {
        $this->Page = (object)[
            'table' => "visits",
            'link' => "visits",
            'Target' => "Visita",
            'Targets' => "Visitas",
            'Titulo' => "Visita",
            'tab' => "",
            'Sex' => "M",
            'titulo_primario' => "",
            'titulo_secundario' => "",
        ];
    }

    public function index()
    {
        $Buscas = Visit::with(['visitor','property','canceler'])->get();
        return view('admin.pages.' . $this->Page->link . '.index')
            ->with('Page', $this->Page)
            ->with('Buscas', $Buscas);
    }

    public function show($id, $tab = 'profile')
    {
        $this->Page->tab = $tab;
        $this->Page->titulo_primario = "Visualização do ";
        $Data = Visit::findOrFail($id);
        return view('admin.pages.' . $this->Page->link . '.show')
            ->with('Data', $Data)
            ->with('Page', $this->Page);
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
