<?php

namespace App\Models\Negociations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NegociationAssign extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $fillable = [
        'idnegociation',
        'owner',
        'name',
        'email',
        'cpf',
        'birthday',
        'status',
    ];


    public function getCreatedAtAttribute($value)
    {
        return DataHelper::getPrettyDateTime($value);
    }
    // ******************** RELASHIONSHIP ******************************
    public function negociation()
    {
        return $this->belongsTo('App\Models\Negociations\Negociation', 'idnegociation');
    }
}
