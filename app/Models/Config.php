<?php

namespace App\Models;

use App\Helpers\DataHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Config extends Model
{
    public $timestamps = true;
    protected $table = 'configs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'meta_key',
        'meta_value'
    ];

    static public function getByMetaKey($value)
    {
        return self::where('meta_key', $value)->first();
    }

    public function getCreatedAtAttribute($value)
    {
        return DataHelper::getPrettyDateTime($value);
    }
}
