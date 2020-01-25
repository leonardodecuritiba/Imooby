<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\Admin;
use App\Models\Photo;
use App\Models\User;

use App\Http\Requests\AdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AdminsController extends Controller
{
    private $name = 'Administrador';
    private $Page;

    public function __construct()
    {
        $this->Page = (object)[
            'table' => "admins",
            'link' => "admins",
            'Target' => "Admin",
            'Targets' => "Admins",
            'Titulo' => "Admin",
            'Sex' => "M",
            'titulo_primario' => "",
            'titulo_secundario' => "",
        ];
    }

    public function index(Request $request)
    {
        if (isset($request['busca'])) {
            $busca = $request['busca'];
            $Buscas = Admin::where('name', 'like', '%' . $busca . '%')
                ->paginate(10);
        } else {
            $Buscas = Admin::paginate(10);
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
        $this->Page->titulo_primario = "Visualização do " . $this->Page->Target;
        $Data = Admin::findOrFail($id);
        return view('admin.pages.' . $this->Page->link . '.master')
            ->with('Data', $Data)
            ->with('Page', $this->Page);
    }

    public function store(AdminRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $User = User::create($data);
        $data['iduser'] = $User->id;
        $User->attachRole(1); // Setting Admin User
        //cadastrar foto
        if ($request->hasfile('photo')) {
            $ImageHelper = new ImageHelper();
            $data['link'] = $ImageHelper->store($request->file('photo'), $this->Page->link);
            $Data = Photo::create($data);
            $data['idphoto'] = $Data->id;
        } else {
            $data['idphoto'] = NULL;
        }
        $Data = Admin::create($data);
        session()->forget('mensagem');
        session(['mensagem' => trans('messages.crud.' . $this->Page->Sex . 'SS', ['name' => $this->name])]);
        return Redirect::route($this->Page->link . '.show', $Data->id);
    }

    public function update(AdminRequest $request, $id)
    {
        $Data = Admin::findOrFail($id);
        $data = $request->all();
        //cadastrar foto
        if ($request->hasfile('photo')) {
            $ImageHelper = new ImageHelper();
            $link = $ImageHelper->update($request->file('photo'), $this->Page->link, $Data->photo->link);
            $Data->photo->update(['link' => $link]);
        }

        $Data->update($data);
        $Data->user->update($data);
        session()->forget('mensagem');
        session(['mensagem' => trans('messages.crud.' . $this->Page->Sex . 'US', ['name' => $this->name])]);
        return Redirect::route($this->Page->link . '.show', $Data->id);
    }

    public function destroy($id)
    {
        $data = Admin::findOrFail($id);
        $data->user->delete();
        $data->photo->delete();
        $data->delete();
        session()->forget('mensagem');
        session(['mensagem' => trans('messages.crud.' . $this->Page->Sex . 'DS', ['name' => $this->name])]);
        return Redirect::route($this->Page->link . '.index');
    }

    public function upd_pass(Request $request, $id)
    {
        $validator = Validator::make($request->all(), ['password' => 'required|confirmed|min:6|max:20']);
        if ($validator->fails()) {
            return redirect()->to($this->getRedirectUrl())
                ->withErrors($validator)
                ->withInput($request->all());
        } else {
            $Data = Admin::findOrFail($id);
            $Data->user->update([
                'password' => bcrypt($request->get('password'))
            ]);
            session()->forget('mensagem');
            session(['mensagem' => trans('messages.crud.' . $this->Page->Sex . 'US', ['name' => $this->name])]);
            return Redirect::route($this->Page->link . '.show', $Data->id);
        }
    }

}
