<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Properties\PropertiesAddressRequest;
use App\Http\Requests\Admin\Properties\PropertiesUploadPhotosRequest;
use App\Models\PropertiesPhoto;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PropertiesController extends AdminController
{
    private $name = 'Imóveis';
    private $single_name = 'Imóvel';
    private $Page;

    public function __construct()
    {
        $this->Page = (object)[
            'table' => "properties",
            'link' => "properties",
            'Target' => "Imóvel",
            'Targets' => "Imóveis",
            'Titulo' => "Imóvel",
            'tab' => "",
            'Sex' => "M",
            'titulo_primario' => "",
            'titulo_secundario' => "",
        ];
    }

    public function index(Request $request)
    {
        if (isset($request['busca'])) {
            $busca = $request['busca'];
            $Buscas = Property::where('name', 'like', '%' . $busca . '%')
                              ->ordered()->get();
        } else {
	        $Buscas = Property::ordered()->get();
        }
        return view('admin.pages.' . $this->Page->link . '.index')
            ->with('Page', $this->Page)
            ->with('Buscas', $Buscas);
    }

    public function show($id, $tab = 'profile')
    {
        $this->Page->tab = $tab;
        $this->Page->titulo_primario = "Visualização do ";
        $Data = Property::findOrFail($id);
        return view('admin.pages.' . $this->Page->link . '.show')
            ->with('Data', $Data)
            ->with('Page', $this->Page);
    }

    public function update(PropertiesAddressRequest $request, $id)
    {
        $Property = Property::find($id);
        $Property->address->update($request->all());
        session()->forget('mensagem');
        session(['mensagem' => trans('messages.crud.' . $this->Page->Sex . 'US', ['name' => $this->single_name])]);

	    return Redirect::route( $this->Page->link . '.show', [ $Property->id, 'address' ] );
    }

	public function updatePhotos( PropertiesUploadPhotosRequest $request ) {
		$Property = Property::find( $request->get( 'idproperty' ) );
		if ( $request->hasFile( 'fotos' ) ) {
			$Property->storePhotos( $request->file( 'fotos' ) );
		}
		session()->forget( 'mensagem' );
		session( [ 'mensagem' => trans( 'messages.crud.' . $this->Page->Sex . 'US', [ 'name' => $this->single_name ] ) ] );

		return Redirect::route( $this->Page->link . '.show', [ $Property->id, 'photos' ] );
    }

    public function activate($id)
    {
        $status = Property::activate($id);
        if ($status) {
            session()->forget('mensagem');
            session(['mensagem' => trans('messages.crud.' . $this->Page->Sex . 'AS', ['name' => $this->single_name])]);
            return Redirect::route($this->Page->link . '.show', $id);
        } else {
	        return Redirect::route( $this->Page->link . '.show', [ $id, 'profile' ] )->withErrors(
                ['Erro' => trans('messages.crud.' . $this->Page->Sex . 'AE', ['name' => $this->single_name])]
            );
        }
    }

    public function disactivate($id)
    {
        $Property = Property::findOrFail($id);
        $Property->disactivate($Property->idowner);
        session()->forget('mensagem');
        session(['mensagem' => trans('messages.crud.' . $this->Page->Sex . 'DAS', ['name' => $this->single_name])]);

	    return Redirect::route( $this->Page->link . '.show', [ $id, 'profile' ] );
    }

	public function destroy( $id ) {
		$Property = Property::findOrFail( $id );
		$Property->delete();
		session()->forget( 'mensagem' );
		session( [ 'mensagem' => trans( 'messages.crud.' . $this->Page->Sex . 'DS', [ 'name' => $this->single_name ] ) ] );

		return Redirect::route( $this->Page->link . '.index' );
	}

	public function destroyPhoto( Request $request, $id, $idproperty ) {
		$PropertiesPhoto = PropertiesPhoto::findOrFail( $id );
		$PropertiesPhoto->delete();
		session()->forget( 'mensagem' );
		session( [ 'mensagem' => trans( 'messages.crud.' . 'FDS', [ 'name' => 'Imagem' ] ) ] );

		return Redirect::route( $this->Page->link . '.show', [ $idproperty, 'photos' ] );
	}

}
