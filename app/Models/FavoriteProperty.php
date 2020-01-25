<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteProperty extends Model
{
    protected $fillable = [
        'idowner',
        'idproperty',
    ];

    public function owner()
    {
        return $this->belongsTo('App\Models\Client', 'idowner');
    }

    public function property()
    {
        return $this->belongsTo('App\Models\Property', 'idproperty');
    }
}
