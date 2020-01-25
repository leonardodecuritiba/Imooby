<?php

namespace App\Models;

use App\Helpers\DataHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisitsStatus extends Model
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
    public function visits()
    {
        return $this->hasMany('App\Models\Visit', 'idvisits_status');
    }
}
