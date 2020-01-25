<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\DataHelper;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ClientsController extends AdminController
{
    private $name = 'Cliente';
    private $Page;

    public function __construct()
    {
        $this->Page = (object)[
            'table' => "clients",
            'link' => "clients",
            'Target' => "Cliente",
            'Targets' => "Clientes",
            'Titulo' => "Cliente",
            'Sex' => "M",
            'tab' => "about",
            'titulo_primario' => "",
            'titulo_secundario' => "",
        ];
    }

    public function index(Request $request)
    {
        if (isset($request['busca'])) {
            $busca = $request['busca'];
            $Buscas = Client::where('name', 'like', '%' . $busca . '%')
                            ->ordered()->get();
        } else {
	        $Buscas = Client::ordered()->get();
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

    public function show($id, $tab = "about")
    {
        $this->Page->tab = $tab;
        $this->Page->titulo_primario = "Visualização do ";
        $Data = Client::findOrFail($id);
        if ($Data->bankData()) {
            $Data->bankData()->create([]);
        }
        return view('admin.pages.' . $this->Page->link . '.show')
            ->with('Data', $Data)
            ->with('Page', $this->Page);
    }

    public function showPerfil()
    {
        return view('admin.pages.' . $this->Page->link . '.show')
            ->with('Client', Auth::user()->client)
            ->with('Page', $this->Page);
    }

    public function disactivate($id)
    {
        $data = Client::findOrFail($id);
        $data->disactivate();
        session()->forget('mensagem');
        session(['mensagem' => trans('messages.crud.' . $this->Page->Sex . 'DAS', ['name' => $this->name])]);
        return Redirect::route($this->Page->link . '.show', $id);
    }

    public function activate($id)
    {
        $data = Client::findOrFail($id);
        $data->activate();
        session()->forget('mensagem');
        session(['mensagem' => trans('messages.crud.' . $this->Page->Sex . 'AS', ['name' => $this->name])]);
        return Redirect::route($this->Page->link . '.show', $id);
    }

//    public function destroy($id)
//    {
//        $data = Client::findOrFail($id);
//        $data->user->delete();
//        $data->photo->delete();
//        $data->delete();
//        return response()->json(['status' => '1',
//            'response' => trans('messages.crud.' . $this->Page->Sex . 'DS', ['name' => $this->name])]);
//    }


}
