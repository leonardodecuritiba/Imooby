<?php

namespace App\Models;

use App\Helpers\DataHelper;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'link',
        'main',
    ];

    public function getCreatedAtAttribute($value)
    {
        return DataHelper::getPrettyDateTime($value);
    }

    // ******************** RELASHIONSHIP ******************************
    public function property()
    {
        return $this->hasOne('App\Models\PropertiesPhoto', 'idphoto');
    }

    public function filename()
    {
        return pathinfo($this->link, PATHINFO_FILENAME);
    }

    public function admin()
    {
        return $this->hasOne('App\Models\Admin', 'idphoto');
    }

    public function client()
    {
        return $this->hasOne('App\Models\Client', 'idphoto');
    }
}
