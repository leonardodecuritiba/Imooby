<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertiesTypeRequest;
use App\Models\PropertiesType;
use Illuminate\Http\Request;

class PropertiesTypesController extends Controller
{
    private $name = 'Tipo de Propriedade';
    private $names = 'Tipos de Propriedades';
    private $Page;

    public function __construct()
    {
        $this->Page = (object)[
            'table' => "properties_types",
            'link' => "properties_types",
            'Target' => $this->name,
            'Targets' => $this->names,
            'Titulo' => $this->name,
            'Sex' => "M",
            'titulo_primario' => "",
            'titulo_secundario' => "",
        ];
    }

    public function index(Request $request)
    {
        if (isset($request['busca'])) {
            $busca = $request['busca'];
            $Buscas = PropertiesType::where('name', 'like', '%' . $busca . '%')
                ->paginate(10);
        } else {
            $Buscas = PropertiesType::paginate(10);
        }
        return view('admin.pages.' . $this->Page->link . '.index')
            ->with('Page', $this->Page)
            ->with('Buscas', $Buscas);
    }

    public function create()
    {
        $this->Page->titulo_primario = "Cadastrar ";
        $this->Page->titulo_secundario = "Dados do " . $this->Page->Target;
        return view('admin.pages.' . $this->Page->link . '.master')
            ->with('Page', $this->Page);
    }

    public function show($id)
    {
        $this->Page->titulo_primario = "Visualização do ";
        $Data = PropertiesType::findOrFail($id);
        return view('admin.pages.' . $this->Page->link . '.master')
            ->with('Data', $Data)
            ->with('Page', $this->Page);
    }

    public function store(PropertiesTypeRequest $request)
    {
        $data = $request->all();
        $Data = PropertiesType::create($data);
        session()->forget('mensagem');
        session(['mensagem' => trans('messages.crud.' . $this->Page->Sex . 'SS', ['name' => $this->name])]);
        return redirect()->route($this->Page->link . '.show', $Data->id);
    }

    public function update(PropertiesTypeRequest $request, $id)
    {
        $Data = PropertiesType::findOrFail($id);
        $data = $request->all();
        $Data->update($data);
        session()->forget('mensagem');
        session(['mensagem' => trans('messages.crud.' . $this->Page->Sex . 'US', ['name' => $this->name])]);
        return redirect()->route($this->Page->link . '.show', $Data->id);
    }

    public function destroy($id)
    {
        $data = PropertiesType::findOrFail($id);
        $data->delete();
        return response()->json(['status' => '1',
            'response' => trans('messages.crud.' . $this->Page->Sex . 'DS', ['name' => $this->name])]);
    }

}
