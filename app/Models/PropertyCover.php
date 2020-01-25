<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyCover extends Model
{
    protected $fillable = [
        'idproperty',
        'idphoto',
    ];

    public function property()
    {
        return $this->belongsTo('App\Models\Property', 'idproperty');
    }

    public function photo()
    {
        return $this->belongsTo('App\Models\Photo', 'idphoto');
    }
}
