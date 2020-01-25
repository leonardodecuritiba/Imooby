<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Requests\ShowProfileRequest;
use App\Http\Requests\BeginClientRequest;
use App\Http\Requests\Profile\ChangePwdRequest;
use App\Http\Requests\Profile\MyPropertiesRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Http\Requests\Profile\UpdatePhotoRequest;
use App\Models\Address;
use App\Models\Client;
use App\Models\Config;
use App\Models\Contact;
use App\Models\PropertiesType;
use App\Models\FavoriteProperty;
use App\Models\Property;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['login', 'beginForm', 'begin']);
    }

    public function editProperty($id)
    {
        if((!Auth::check()) || (Auth::user()->client == NULL)) return abort(404);
        $Property = Property::myProperty($id, Auth::user()->client->id);
        //testar se é do próprio user
        $this->_SELF_TEMPLATE_['Property'] = $Property;
        $this->_SELF_TEMPLATE_['PropertiesType'] = PropertiesType::all();
        $this->_SELF_TEMPLATE_['PropertyFee'] = Config::getByMetaKey('rental_fee')->meta_value;
        return view('site.properties.master')
            ->with('_SELF_TEMPLATE_', $this->_SELF_TEMPLATE_);
    }

    public function editCoverProperty($id)
    {
        if((!Auth::check()) || (Auth::user()->client == NULL)) return abort(404);
        $Property = Property::myProperty($id, Auth::user()->client->id);
        //testar se é do próprio user
        $this->_SELF_TEMPLATE_['Property'] = $Property;
        $this->_SELF_TEMPLATE_['PropertiesType'] = PropertiesType::all();
        $this->_SELF_TEMPLATE_['PropertyFee'] = Config::getByMetaKey('rental_fee')->meta_value;
        return view('site.properties.cover')
            ->with('_SELF_TEMPLATE_', $this->_SELF_TEMPLATE_);
    }

    public function changePhoto(UpdatePhotoRequest $request)
    {
        if ($request->hasFile('photo')) {
            Auth::user()->client->changePhoto($request->file('photo'));
            session(['status' => 'Foto alterada com sucesso!']);
        }
        return Redirect::route('profile.my');
    }

    public function update(UpdateProfileRequest $request)
    {
        Auth::user()->client->update($request->only(['name']));
        Auth::user()->client->contact()->update($request->only(['phone', 'cellphone']));
        Auth::user()->client->address()->update($request->only(['zip', 'state', 'city', 'district', 'street', 'number', 'complement']));
        Auth::user()->client->bankData()->update($request->only(['agency', 'account_type', 'account_number', 'owner_name', 'cpf']));

        return Redirect::route('profile.my');
    }

    public function show(ShowProfileRequest $request)
    {
        if (Auth::user()->client->bankData()) {
            Auth::user()->client->bankData()->create([]);
        }
        $this->_SELF_TEMPLATE_['States'] = array(
            array("sigla" => "AC", "nome" => "Acre"),
            array("sigla" => "AL", "nome" => "Alagoas"),
            array("sigla" => "AM", "nome" => "Amazonas"),
            array("sigla" => "AP", "nome" => "Amapá"),
            array("sigla" => "BA", "nome" => "Bahia"),
            array("sigla" => "CE", "nome" => "Ceará"),
            array("sigla" => "DF", "nome" => "Distrito Federal"),
            array("sigla" => "ES", "nome" => "Espírito Santo"),
            array("sigla" => "GO", "nome" => "Goiás"),
            array("sigla" => "MA", "nome" => "Maranhão"),
            array("sigla" => "MT", "nome" => "Mato Grosso"),
            array("sigla" => "MS", "nome" => "Mato Grosso do Sul"),
            array("sigla" => "MG", "nome" => "Minas Gerais"),
            array("sigla" => "PA", "nome" => "Pará"),
            array("sigla" => "PB", "nome" => "Paraíba"),
            array("sigla" => "PR", "nome" => "Paraná"),
            array("sigla" => "PE", "nome" => "Pernambuco"),
            array("sigla" => "PI", "nome" => "Piauí"),
            array("sigla" => "RJ", "nome" => "Rio de Janeiro"),
            array("sigla" => "RN", "nome" => "Rio Grande do Norte"),
            array("sigla" => "RO", "nome" => "Rondônia"),
            array("sigla" => "RS", "nome" => "Rio Grande do Sul"),
            array("sigla" => "RR", "nome" => "Roraima"),
            array("sigla" => "SC", "nome" => "Santa Catarina"),
            array("sigla" => "SE", "nome" => "Sergipe"),
            array("sigla" => "SP", "nome" => "São Paulo"),
            array("sigla" => "TO", "nome" => "Tocantins")
        );
        $this->_SELF_TEMPLATE_['Profile'] = Auth::user()->client;
        return view('site.profile.show')
            ->with('_SELF_TEMPLATE_', $this->_SELF_TEMPLATE_);
    }

    public function changePwd(ChangePwdRequest $request)
    {
        Auth::user()->changePwd($request->all());
        session(['status' => 'Senha alterada com sucesso!']);
        return Redirect::route('profile.my');
    }

    public function myProperties(MyPropertiesRequest $request)
    {
        $Properties = Auth::user()->client->propertiesInfoBox();
        $this->_SELF_TEMPLATE_['Properties'] = $Properties['data'];
        $this->_SELF_TEMPLATE_['PropertiesInfoBox'] = json_encode($Properties['infoBoxData']);
        return view('site.profile.properties')
            ->with('_SELF_TEMPLATE_', $this->_SELF_TEMPLATE_);
    }

    public function myFavorites(MyPropertiesRequest $request)
    {
        $Properties = Auth::user()->client->favoritesBox();
        $this->_SELF_TEMPLATE_['Properties'] = $Properties['data'];
        $this->_SELF_TEMPLATE_['PropertiesInfoBox'] = json_encode($Properties['infoBoxData']);
        return view('site.profile.favorites')
            ->with('_SELF_TEMPLATE_', $this->_SELF_TEMPLATE_);
    }

    public function like($id)
    {
        $Property = Property::find($id);
        $like = FavoriteProperty::where('idowner', auth()->user()->client->id)
            ->where('idproperty', $id)
        ->first();

        if(!$like)
            FavoriteProperty::create([
                'idowner' => auth()->user()->client->id,
                'idproperty' => $id]
            );

        return Redirect::route('ver-imovel', $id);
    }

    public function unlike($id)
    {
        $Property = Property::find($id);
        $like = FavoriteProperty::where('idowner', auth()->user()->client->id)
            ->where('idproperty', $id)
        ->first();

        if($like)
            $like->delete();

        return Redirect::route('ver-imovel', $id);
    }

    public function mySchedules()
    {
        $this->_SELF_TEMPLATE_['Visits'] = Auth::user()->client->visits;
        $this->_SELF_TEMPLATE_['Schedules'] = Auth::user()->client->getSchedulesPaginated();
        return view('site.profile.schedules')
            ->with('_SELF_TEMPLATE_', $this->_SELF_TEMPLATE_);
    }

    public function myNegociations()
    {
        $Client = Auth::user()->client;
        $this->_SELF_TEMPLATE_['Visits'] = $Client->availableNegociations();
        $this->_SELF_TEMPLATE_['RenterNegociations'] = $Client->renter_negociations;
        $this->_SELF_TEMPLATE_['OwnerNegociations'] = $Client->owner_negociations()->get();

        return view('site.profile.negociations')
            ->with('_SELF_TEMPLATE_', $this->_SELF_TEMPLATE_);
    }

    public function showNegociation($id)
    {
        $Client = Auth::user()->client;
        $Negociation = $Client->getMyNegociation($id);
        $this->_SELF_TEMPLATE_['Negociation'] = $Negociation;

        //renter/ owner
        $who = $Negociation->whois($Client->id);

        //testar se é minha negociação
        $this->_SELF_TEMPLATE_['Conditions'] = Config::getByMetaKey($who . '_conditions')->meta_value;

        return view('site.profile.' . $who . '_negociate')
            ->with('_SELF_TEMPLATE_', $this->_SELF_TEMPLATE_);
    }

    public function begin(BeginClientRequest $request)
    {
        $phone = $request->phone;
        $data = $request->except(['phone']);
        //address
        $Data = Address::create();
        $data['idaddress'] = $Data->id;
        //contact
        $Data = Contact::create();
        $data['idcontact'] = $Data->id;
        //user
        $data['password'] = bcrypt($data['password']);
        $Data = User::create($data);
        $data['iduser'] = $Data->id;
        $Data->attachRole(2); // Setting Client User
        //client
        $client = Client::create($data);
        $client->contact()->update(['cellphone'=>$phone]);
        $LoginController = new LoginController();
        return $LoginController->loginRegistred($request);
    }

    public function beginForm()
    {
        if(\Auth::guest()) {
            return view('site.register')->with('page_title', 'Cadastrar');
        }
        abort(404);
    }

    public function login()
    {
        if(\Auth::guest()) {
            return view('site.login')->with('page_title', 'Entrar');
        }
        abort(404);
    }


}
