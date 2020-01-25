<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfigurationsRequest;
use App\Models\Config;
use Illuminate\Http\Request;

class ConfigurationsController extends Controller
{
    private $name = 'Configuração';
    private $names = 'Configurações';
    private $Page;

    public function __construct()
    {
        $this->Page = (object)[
            'table' => "configurations",
            'link' => "configurations",
            'Target' => $this->name,
            'Targets' => $this->names,
            'Titulo' => $this->name,
            'Sex' => "F",
            'titulo_primario' => "",
            'titulo_secundario' => "",
        ];
    }

    public function index(ConfigurationsRequest $request)
    {
        $Buscas = Config::all();
        return view('admin.pages.' . $this->Page->link . '.index')
            ->with('Page', $this->Page)
            ->with('Buscas', $Buscas);
    }

    public function store(ConfigurationsRequest $request)
    {
        $data = $request->all();
        $Data = Config::create($data);
        session()->forget('mensagem');
        session(['mensagem' => trans('messages.crud.' . $this->Page->Sex . 'SS', ['name' => $this->name])]);
        return redirect()->route($this->Page->link . '.index');
    }

    public function update(ConfigurationsRequest $request, $id)
    {
        $Data = Config::findOrFail($id);
        $data = $request->all();
        $Data->update($data);
        session()->forget('mensagem');
        session(['mensagem' => trans('messages.crud.' . $this->Page->Sex . 'US', ['name' => $this->name])]);
        return redirect()->route($this->Page->link . '.index');
    }

    public function destroy($id)
    {
        $data = Config::findOrFail($id);
        $data->delete();
        return response()->json(['status' => '1',
            'response' => trans('messages.crud.' . $this->Page->Sex . 'DS', ['name' => $this->name])]);
    }

}
