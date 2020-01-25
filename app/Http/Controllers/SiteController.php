<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Message;
use App\Models\PropertiesType;
use App\Models\Property;
use App\Models\Visit;
use App\Providers\AppServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SiteController extends Controller
{
    private $_SELF_TEMPLATE_;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->_SELF_TEMPLATE_['Properties'] = Property::news(6);
        return view('site.index')
            ->with('_SELF_TEMPLATE_', $this->_SELF_TEMPLATE_);
    }

    public function showProperty($id)
    {
        $Property = Property::getValid($id);
        $Similars = $Property->getSimilar(6);

        $this->_SELF_TEMPLATE_['Property'] = $Property;
        $this->_SELF_TEMPLATE_['SimilarProperties'] = $Similars['query'];
        $this->_SELF_TEMPLATE_['SimilarPropertiesInfoBox'] = json_encode($Similars['infoBoxData']);

        return view('site.ver-imovel')
            ->with('_SELF_TEMPLATE_', $this->_SELF_TEMPLATE_);
    }

    public function searchProperties(Request $request)
    {
        $data = $request->all();
        
        if(!isset($data['busca']) || $data['busca']==NULL){
            $page_title = 'Buscar imóveis';
            $data = [
                'lat'   => -25.429415,
                'lng'   => -49.271921,
            ];
        } else {
            $page_title = 'Imóveis em '.$data['busca'];
        }

        $this->_SELF_TEMPLATE_ = Property::getByLocation($data);
        return view('site.buscar-imoveis')
            ->with('_SELF_TEMPLATE_', $this->_SELF_TEMPLATE_)
            ->with('page_title', $page_title);
    }

    public function searchPropertiesTest(Request $request)
    {
        $data = $request->all();
        if(!isset($data['busca']) || $data['busca']==NULL){
            $data = [
                'lat'   => -25.429415,
                'lng'   => -49.271921,
            ];
        }

        $this->_SELF_TEMPLATE_ = Property::getByLocation($data);
        return view('site.buscar-imoveis2')
            ->with('_SELF_TEMPLATE_', $this->_SELF_TEMPLATE_);
    }

    public function contact(Request $request)
    {
        $this->validate($request, [
            'message'=>'required|max:512'
            ]);
        if(\Auth::guest()) {
            Message::create($request->only(['name', 'email', 'phone', 'message']));
            session()->forget('status');
            session(['status' => 'Mensagem enviado com sucesso!']);
            return Redirect::route('index');
        }
        return redirect()->route('contactLogged');
    }

    public function contactLogged(Request $request)
    {
        $this->validate($request, [
            'message'=>'required|max:512'
            ]);
        if (\Auth::check()) {
            $user = \Auth::user();
        Message::create([
            'name'=>$user->getFullName(),
            'email'=>$user->email,
            'phone'=>$user->getPhone(),
            'message'=>$request->message
            ]);
        session()->forget('status');
        session(['status' => 'Mensagem enviado com sucesso!']);
        return Redirect::route('index');
        }
    }

    public function formRegisterProperty(Request $request)
    {
        if (\Auth::check()) {
            $this->_SELF_TEMPLATE_['PropertiesType'] = PropertiesType::all();
            $this->_SELF_TEMPLATE_['PropertyFee'] = Config::getByMetaKey('rental_fee')->meta_value;
            return view('site.properties.master')
            ->with('_SELF_TEMPLATE_', $this->_SELF_TEMPLATE_);
        } else {
            session(['tried_to' => 'property.create']);
            return redirect()->guest('register');
        }
    }

    public function propertiesList()
    {
        $properties = Property::paginate(20);
        return view('site.properties.list')->with('properties', $properties);
    }

}
