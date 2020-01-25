<?php

namespace App\Observers;

use App\Models\Admin;
use App\Models\Client;
use App\Notifications\NewRegisterNotify;

class ClientObserver {
	/**
	 * Listen to the User created event.
	 *
	 * @param  Client $client
	 *
	 * @return void
	 */
	public function created( Client $client ) {
		Admin::all()->each( function ( $a ) use ( $client ) {
			$a->user->notify( new NewRegisterNotify( [
				'name'    => $a->name,
				'subject' => 'Novo Cadastro',
				'message' => 'Um novo usuário acabou de se cadastrar no sistema, clique no link abaixo para visualizá-lo.',
				'link'    => route( 'clients.show', $client->id ),
			] ) );
		} );
	}
}