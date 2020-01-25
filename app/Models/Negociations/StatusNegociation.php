<?php

namespace App\Models\Negociations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusNegociation extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $fillable = [
        'description'
    ];

    public function getCreatedAtAttribute($value)
    {
        return DataHelper::getPrettyDateTime($value);
    }

    // ******************** RELASHIONSHIP ******************************
    public function negociations()
    {
        return $this->hasMany('App\Models\Negociations\Negociation', 'idstatus_negociation');
    }
}
