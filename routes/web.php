<?php

/*
|--------------------------------------------------------------------------
| Login Routes
|--------------------------------------------------------------------------
|
*/
Auth::routes();
Route::get('login', 'ProfileController@login')->name('login.form');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'administrativo', 'middleware' => ['role:admin']], function () {
    Route::get('/', function () {
        return view('admin.welcome');
    })->name('administrativo');

    Route::resource('admins', 'AdminsController');
    Route::post('pwd/{admin}/admins', 'AdminsController@upd_pass')->name('admins.upd_pass');

    Route::resource('properties_types', 'PropertiesTypesController');

    Route::resource('clients', 'Admin\ClientsController');
    Route::get('disactivate/clients/{id}', 'Admin\ClientsController@disactivate')->name('clients.disactivate');
    Route::get('activate/clients/{id}', 'Admin\ClientsController@activate')->name('clients.activate');

    Route::resource('properties', 'Admin\PropertiesController');
	Route::get( 'properties/{id}/{tab}', 'Admin\PropertiesController@show' )->name( 'properties.show' );
    Route::get('activate/properties/{idproperty}', 'Admin\PropertiesController@activate')->name('properties.activate');
    Route::get('disactivate/properties/{idproperty}', 'Admin\PropertiesController@disactivate')->name('properties.disactivate');
	Route::post( 'update-photos/properties', 'Admin\PropertiesController@updatePhotos' )->name( 'properties.update-photos' );

    Route::resource('visits', 'VisitsController');
    Route::resource('visits_status', 'VisitsStatusController');
    Route::resource('status_negociations', 'StatusNegociationsController');
    Route::resource('conditions', 'ConditionsController');
    Route::resource('configurations', 'ConfigurationsController');
    Route::resource('negociations', 'Admin\NegociationsAdminController');
    Route::get('admin-accept-documents/{id}', 'Admin\NegociationsAdminController@acceptDocument')->name('admins.negociations.acceptDocument');
    Route::get('admin-reject-documents/{id}', 'Admin\NegociationsAdminController@rejectDocument')->name('admins.negociations.rejectDocument');

    Route::get('admin-accept-owner-documents/{id}', 'Admin\NegociationsAdminController@acceptAdminOwnerDocument')->name('admins.negociations.acceptOwnerDocuments');
    Route::get('admin-accept-renter-documents/{id}', 'Admin\NegociationsAdminController@acceptAdminRenterDocuments')->name('admins.negociations.acceptRenterDocuments');

    Route::get('admin-reject-renter-documents/{id}', 'Admin\NegociationsAdminController@rejectAdminRenterDocuments')->name('admins.negociations.rejectRenterDocuments');
    Route::get('admin-reject-owner-documents/{id}', 'Admin\NegociationsAdminController@rejectAdminOwnerDocument')->name('admins.negociations.rejectOwnerDocuments');

    Route::resource('messages', 'MessageController');
    Route::post('contatos-responder/{id}', 'MessageController@responder')->name('contatos.responder');
});

/*
|--------------------------------------------------------------------------
| Blog Routes
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'blog'], function () {
    Route::get('/', 'BlogController@index')->name('blog.index');
    Route::post('/comment', 'BlogController@comment')->name('blog.comment');
    Route::get('/procurar', 'BlogController@searchPost')->name('blog.searchPost');
    Route::get('/{category}/{title}', 'BlogController@show')->name('blog.show');
    Route::get('/{category}', 'BlogController@showCategory')->name('blog.showCategory');
});
Route::group(['prefix' => 'blog-admin', 'middleware' => ['role:admin']], function () {
    Route::get('/', 'BlogController@adminIndex')->name('blog.adminIndex');
    Route::get('/post', 'BlogController@createPost')->name('blog.createPost');
    Route::get('/category', 'BlogController@createCategory')->name('blog.createCategory');
    Route::post('/post', 'BlogController@storePost')->name('blog.storePost');
    Route::get('/post/edit/{id}', 'BlogController@editPost')->name('blog.editPost');
    Route::post('/post/edit', 'BlogController@updatePost')->name('blog.updatePost');
    Route::get('/post/delete/{id}', 'BlogController@deletePost')->name('blog.deletePost');
    Route::post('/post/photo/{id}', 'BlogController@postPhoto')->name('blog.postPhoto');
    Route::post('/category', 'BlogController@storeCategory')->name('blog.storeCategory');
    Route::get('/category/edit/{id}', 'BlogController@editCategory')->name('blog.editCategory');
    Route::post('/category/edit', 'BlogController@updateCategory')->name('blog.updateCategory');
});

/*
|--------------------------------------------------------------------------
| Site Routes
|--------------------------------------------------------------------------
|
*/
//Properties routes
Route::get('ver-imovel/{id}', 'SiteController@showProperty')->name('ver-imovel');
Route::get('lista-de-imoveis', 'SiteController@propertiesList')->name('lista-de-imoveis');
Route::get('buscar-imoveis', 'SiteController@searchProperties')->name('buscar-imoveis');
Route::get('buscar-imoveis-test', 'SiteController@searchPropertiesTest')->name('buscar-imoveis-test');
Route::get('home', 'SiteController@index');
Route::get('/', 'SiteController@index')->name('index');
Route::get('fale-conosco', function(){ return view('site.fale-conosco')->with('page_title', 'Contato'); })->name('contactus');
Route::post('contact', 'SiteController@contact')->name('contact');
Route::post('contactl', 'SiteController@contactLogged')->name('contactLogged');
Route::get('buscar-imoveis-json', 'AjaxController@searchJsonProperties')->name('properties.ajax');

//Closures
Route::get('termos-de-uso', function () {
    return view('site.termos-de-uso');
})->name('termos-de-uso');
Route::get('politicas-de-privacidade', function () {
    return view('site.politicas-de-privacidade');
})->name('politicas-de-privacidade');

Route::get('recuperar-senha', function () {//url
    return view('auth.passwords.recuperar');//open page in view
})->name('recuperar-senha');

Route::get('como-funciona-proprietario', function () {//url
    return view('site.funcionamento.proprietario')->with('page_title', 'Como funciona para o proprietário');
})->name('como-funciona-proprietario');

Route::get('como-funciona-inquilino', function () {//url
    return view('site.funcionamento.inquilino')->with('page_title', 'Como funciona para o inquilino');
})->name('como-funciona-inquilino');

Route::get('sobre-nos', function () {
    return view('site.sobre-nos')->with('page_title', 'Sobre nós');
})->name('sobre-nos');

Route::get('registrar', function () {//friendly url
    return redirect()->route('clients.beginForm');
})->name('registrar');//expression for html

Route::get('contato', function () {
    return view('site.contato')->with('page_title', 'Contato');;
});

Route::get('agendamento', function () {
    return view('site.agendamento');
});

//Route::get('cadastro', function () {
//    return view('site.cadastro-usuario');
//});

// Facebook
Route::get('facebook-redirect', 'SocialMediaController@facebookRedirect')->name('facebook.redirect');
Route::get('facebook-handle', 'SocialMediaController@facebookHandle')->name('facebook.handle');

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
|
*/
Route::get('meus-imoveis', 'ProfileController@myProperties')->name('profile.properties');
Route::get('favoritar/{id}', 'ProfileController@like')->name('property.like');
Route::get('desfavoritar/{id}', 'ProfileController@unlike')->name('property.unlike');
Route::get('meus-favoritos', 'ProfileController@myFavorites')->name('profile.favorites');
Route::get('meus-agendamentos', 'ProfileController@mySchedules')->name('profile.schedules');
Route::get('minhas-negociacoes', 'ProfileController@myNegociations')->name('profile.negociations');
Route::get('meu-perfil', 'ProfileController@show')->name('profile.my');
Route::post('alterar-senha', 'ProfileController@changePwd')->name('profile.new_pwd');
Route::post('atualizar-perfil', 'ProfileController@update')->name('profile.update');
Route::post('alterar-foto', 'ProfileController@changePhoto')->name('profile.change_photo');
Route::get('editar-imovel/{id}', 'ProfileController@editProperty')->name('property.edit');
Route::get('editar-capa/{id}', 'ProfileController@editCoverProperty')->name('property.change_cover');


Route::post( 'atualizar-imovel/{id}', 'Client\PropertiesController@update' )->name( 'property.update' );
Route::get( 'remover-foto-imovel/{id}', 'Client\PropertiesController@destroyPhoto' )->name( 'property-photo.destroy' );
Route::get( 'admin-remover-foto-imovel/{id}/{idproperty}', 'Admin\PropertiesController@destroyPhoto' )->name( 'admin-property-photo.destroy' );
Route::get( 'salvar-capa/{pid}/{phid}', 'Client\PropertiesController@updateCover' )->name( 'property.change_cover_action' );
Route::post( 'salvar-imovel', 'Client\PropertiesController@store' )->name( 'property.store' );
Route::get( 'disponibilidade-visitas/{id}', 'Client\PropertiesController@scheduler' )->name( 'scheduler' );
//Route::post( 'disponibilidade-visitas/store/{id}', 'Client\PropertiesController@addPropertySchedule' )->name( 'scheduler.add' );
Route::post( 'disponibilidade-visitas/store', 'Client\PropertiesController@addPropertySchedule' )->name( 'scheduler.add' );
Route::get( 'scheduler/delete/{pid}/{sid}', 'Client\PropertiesController@removePropertySchedule' )->name( 'scheduler.remove' );
Route::get( 'property/get-available-times/{id}', 'Client\PropertiesController@getAvailableTimes' )->name( 'scheduler.gettimes' );

Route::get('anunciar-imovel', 'SiteController@formRegisterProperty')->name('property.create');
Route::post('cadastrar-usuario', 'ProfileController@begin')->name('clients.begin');
Route::get('cadastrar', 'ProfileController@beginForm')->name('clients.beginForm');
Route::get('register', 'ProfileController@beginForm')->name('clients.beginForm2');

/*
|--------------------------------------------------------------------------
| Schedule Routes
|--------------------------------------------------------------------------
|
*/
Route::post('agendar-visita', 'ScheduleController@create')->name('schedule.store');
Route::post('confirmar-visita-proprietario/{idvisit}', 'ScheduleController@ownerConfirm')->name('schedule.owner_confirm');
Route::post('confirmar-visita-inquilino/{idvisit}', 'ScheduleController@visitorConfirm')->name('schedule.visitor_confirm');
Route::post('cancelar-visita/{idvisit}', 'ScheduleController@cancel')->name('schedule.cancel');
Route::post('reagendar-visita/{idvisit}', 'ScheduleController@refresh')->name('schedule.refresh');
//Route::post('update-owner-step/{id}', 'NegociationsController@updateOwnerStep')->name('negociation.update.owner_step');
//Route::post('confirmar-visita-proprietario/{idvisit}', 'ScheduleController@ownerConfirm')->name('schedule.owner_confirm');
//Route::post('confirmar-visita-inquilino/{idvisit}', 'ScheduleController@visitorConfirm')->name('schedule.visitor_confirm');
//Route::post('cancelar-visita/{idvisit}', 'ScheduleController@cancel')->name('schedule.cancel');
//Route::post('reagendar-visita/{idvisit}', 'ScheduleController@refresh')->name('schedule.refresh');

/*
|--------------------------------------------------------------------------
| Negociations Routes
|--------------------------------------------------------------------------
|
*/
Route::get('visualizar-negociacao/{id}', 'ProfileController@showNegociation')->name('negociation.show');
//PASSO 1
Route::post('nova-negociacao', 'NegociationsController@open')->name('negociation.open');
//PASSO 2
Route::post('accept-renter-conditions/{id}', 'NegociationsController@acceptRenterConditions')->name('negociation.update.acceptRenterConditions');
Route::post('send-renter-propose/{id}', 'NegociationsController@submitRenterPropose')->name('negociation.update.submitRenterPropose');
Route::post('accept-renter-propose/{id}', 'NegociationsController@acceptRenterPropose')->name('negociation.update.acceptRenterPropose');
Route::post('accept-owner-conditions/{id}', 'NegociationsController@acceptOwnerConditions')->name('negociation.update.acceptOwnerConditions');
//PASSO 3
Route::post('submit-owner-documents/{id}', 'NegociationsController@submitOwnerDocuments')->name('negociation.update.submitOwnerDocuments');
Route::post('submit-renter-documents/{id}', 'NegociationsController@submitRenterDocuments')->name('negociation.update.submitRenterDocuments');
// PASSO 4
// Url para verificar documentação
Route::get('verify-negotiation-signature/{id}', 'NegociationsController@verifySignature');

/*
|--------------------------------------------------------------------------
| Testes Routes
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'teste'], function () {
    Route::get('login_ok', function () {
        return 'ok';
    })->name('login_ok');
    Route::get('news', function () {
        foreach (\App\Models\Property::news(6) as $new) {
            print_r($new->id);
            print_r($new->main_photo());
        }
        return;
        return \App\Models\Property::news(6);
    });
    Route::get('email-admins', function () {


	    $client = \App\Models\Client::find( 1 );
	    \App\Models\Admin::all()->each( function ( $a ) use ( $client ) {
		    $a->user->notify( new \App\Notifications\NewRegisterNotify( [
			    'name'    => $a->name,
			    'subject' => 'Novo Cadastro',
			    'message' => 'Um novo usuário acabou de se cadastrar no sistema, clique no link abaixo para visualizá-lo.',
			    'link'    => route( 'clients.show', $client->id ),
		    ] ) );
	    } );

	    exit;

        $Admins = \App\Models\Admin::pluck('iduser');
        $UsersAdmin = \App\Models\User::whereIn('id', $Admins)->get();
//    $UsersAdmin = [$UsersAdmin[0]];
        foreach ($UsersAdmin as $user) {
            echo 'send to: ' . $user->admin->name;
            $user->notify(new \App\Notifications\NegociateNotify([
                'name' => $user->admin->name,
                'subject' => 'assunto teste',
                'message' => 'mensagem admin teste',
                'recomendation' => '',
                'link' => '',
            ]));
        }
    });
});


