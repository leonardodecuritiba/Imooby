<?php

namespace App\Models;

use App\Helpers\DataHelper;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'name',
        'client_id',
        'email',
        'phone',
        'message',
        'status'
    ];

    public function getCreatedAtAttribute($value)
    {
        return DataHelper::getPrettyDateTime($value);
    }

    public function answer()
    {
        $this->attributes['status'] = 1;
        return $this->save();
    }

    public function status_text()
    {
        return ($this->attributes['status']) ? 'Respondido' : 'Não Respondido';
    }

    public static function client()
    {
        return $this->belongsTo(Client::class);
    }
}
