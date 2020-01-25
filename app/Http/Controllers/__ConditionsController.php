<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConditionsRequest;
use App\Models\Negociations\Condition;
use Illuminate\Http\Request;

class ConditionsController extends Controller
{
    private $name = 'Condição';
    private $names = 'Condições';
    private $Page;

    public function __construct()
    {
        $this->Page = (object)[
            'table' => "conditions",
            'link' => "conditions",
            'Target' => $this->name,
            'Targets' => $this->names,
            'Titulo' => $this->name,
            'Sex' => "F",
            'titulo_primario' => "",
            'titulo_secundario' => "",
        ];
    }

    public function index(ConditionsRequest $request)
    {
        if (isset($request['busca'])) {
            $busca = $request['busca'];
            $Buscas = Condition::where('name', 'like', '%' . $busca . '%')
                ->paginate(10);
        } else {
            $Buscas = Condition::paginate(10);
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
        $Data = Condition::findOrFail($id);
        return view('admin.pages.' . $this->Page->link . '.master')
            ->with('Data', $Data)
            ->with('Page', $this->Page);
    }

    public function store(ConditionsRequest $request)
    {
        $data = $request->all();
        $Data = Condition::create($data);
        session()->forget('mensagem');
        session(['mensagem' => trans('messages.crud.' . $this->Page->Sex . 'SS', ['name' => $this->name])]);
        return redirect()->route($this->Page->link . '.show', $Data->id);
    }

    public function update(ConditionsRequest $request, $id)
    {
        $Data = Condition::findOrFail($id);
        $data = $request->all();
        $Data->update($data);
        session()->forget('mensagem');
        session(['mensagem' => trans('messages.crud.' . $this->Page->Sex . 'US', ['name' => $this->name])]);
        return redirect()->route($this->Page->link . '.show', $Data->id);
    }

    public function destroy($id)
    {
        $data = Condition::findOrFail($id);
        $data->delete();
        return response()->json(['status' => '1',
            'response' => trans('messages.crud.' . $this->Page->Sex . 'DS', ['name' => $this->name])]);
    }

}
