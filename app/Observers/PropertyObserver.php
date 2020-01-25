<?php

namespace App\Observers;

use App\Models\Admin;
use App\Models\Property;
use App\Notifications\NewRegisterNotify;

class PropertyObserver
{
	/**
	 * Listen to the Property created event.
	 *
	 * @param  Property $property
	 *
	 * @return void
	 */
	public function created( Property $property ) {
		Admin::all()->each( function ( $a ) use ( $property ) {
			$a->user->notify( new NewRegisterNotify( [
				'name'    => $a->name,
				'subject' => 'Novo Imóvel',
				'message' => 'Um novo imóvel foi cadastrado no sistema, clique no link abaixo para visualizá-lo.',
				'link'    => route( 'properties.show', ['id'=>$property->id, 'tab'=>'profile'] ),
			] ) );
		} );
	}
    /**
     * Listen to the User created event.
     *
     * @param  Property $property
     * @return void
     */
    public function creating(Property $property)
    {
        foreach (Property::ON_FIELDS as $field) {
            if (isset($property->$field)) {
                $property->$field = 1;
            }
        }
    }
    /**
     * Listen to the Property updated event.
     *
     * @param  Property $property
     *
     * @return void
     */
    public function updating(Property $property)
    {
        foreach (Property::ON_FIELDS as $field) {
            $property->$field = ($property->$field == 'on')?1:0;
        }
    }

	/**
	 * Listen to the Property deleting event.
     *
     * @param  Property $property
     * @return void
     */
    public function deleting(Property $property) {
	    //ao remover
	    //negociations, visits, cover, properties_photo, schedules, address
	    $property->negociations->each( function ( $c ) {
		    $c->delete();
	    } );
	    if ( $property->cover != null ) {
		    $property->cover->delete();
	    }
	    if ( $property->address != null ) {
		    $property->address->delete();
	    }
	    $property->visits->each( function ( $c ) {
		    $c->forceDelete();
	    } );
	    $property->properties_photo->each( function ( $c ) {
		    $c->delete();
	    } );
	    $property->schedules->each( function ( $c ) {
		    $c->delete();
	    } );
	    $property->favorites->each( function ( $c ) {
		    $c->delete(); });
    }
}