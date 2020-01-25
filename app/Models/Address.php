<?php

namespace App\Models;

use App\Helpers\DataHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $fillable = [
        'lat',
        'lng',
        'zip',
        'state',
        'city',
        'district',
        'street',
        'number',
        'complement'
    ];


    public function getFormatedZip()
    {
        return DataHelper::mask($this->attributes['zip'], '#####-###');
    }
    public function getFullAddress()
    {
        return $this->getFullStreet() . ', ' . $this->getStateCity();
    }

    public function getFullStreet()
    {
        return $this->attributes['street'] . ', ' . $this->attributes['number'];
    }

    public function getStateCity()
    {
        return $this->attributes['city'] . ' - ' . $this->attributes['state'];
    }

    public function getCreatedAtAttribute($value)
    {
        return DataHelper::getPrettyDateTime($value);
    }

    public function setZipAttribute($value)
    {
        return $this->attributes['zip'] = DataHelper::getOnlyNumbers($value);
    }

    // ******************** RELASHIONSHIP ******************************
    public function property()
    {
        return $this->hasOne('App\Models\PropertiesPhoto', 'idphoto');
    }

    public function client()
    {
        return $this->hasOne('App\Models\Client', 'idphoto');
    }
}
