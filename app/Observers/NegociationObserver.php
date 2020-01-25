<?php

namespace App\Observers;


use App\Models\Negociations\AcceptedCondition;
use App\Models\Negociations\Condition;
use App\Models\Negociations\Negociation;

class NegociationObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  Negociation $negociation
     * @return void
     */
    public function created(Negociation $negociation)
    {
    }
    /**
     * Listen to the User updated event.
     *
     * @param  Negociation $negociation
     * @return void
     */
    public function updating(Negociation $negociation)
    {
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  Negociation $negociation
     * @return void
     */
    public function deleting(Negociation $negociation)
    {
        //
    }
}