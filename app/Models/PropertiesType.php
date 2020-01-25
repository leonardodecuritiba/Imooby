<?php

namespace App\Models;

use App\Helpers\DataHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertiesType extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $fillable = [
        'description',
    ];

    public function getCreatedAtAttribute($value)
    {
        return DataHelper::getPrettyDateTime($value);
    }

    // ******************** RELASHIONSHIP ******************************
    public function properties()
    {
        return $this->hasMany('App\Models\Property', 'idproperties_type');
    }
}
