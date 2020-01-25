<?php

namespace App\Models;

use App\Helpers\DataHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $fillable = [
        'phone',
        'cellphone',
        'skype',
        'facebook',
        'google_plus',
        'pinterest',
        'twitter',
    ];

    public function setPhoneAttribute($value)
    {
        return $this->attributes['phone'] = DataHelper::getOnlyNumbers($value);
    }

    public function setCellphoneAttribute($value)
    {
        return $this->attributes['cellphone'] = DataHelper::getOnlyNumbers($value);
    }

    public function getFormatedPhone()
    {
        return DataHelper::mask($this->attributes['phone'], '(##)####-####');
    }

    public function getFormatedCellphone()
    {
        return DataHelper::mask($this->attributes['cellphone'], '(##)#####-####');
    }
    public function getCreatedAtAttribute($value)
    {
        return DataHelper::getPrettyDateTime($value);
    }

    // ******************** RELASHIONSHIP ******************************
    public function client()
    {
        return $this->hasOne('App\Models\Client', 'idcontact');
    }
}
