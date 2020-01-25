<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\DataHelper;
use Jenssegers\Date\Date;

class PropertySchedule extends Model
{
    protected $fillable = ['day', 'from', 'to', 'period'];
    
    public function formatedDate()
    {
        return DataHelper::getPrettyDate($this->day);
    }

    public function formatedFrom()
    {
        return Date::createFromFormat('H:i:s', $this->from)->format('H:i');
    }

    public function formatedTo()
    {
        return Date::createFromFormat('H:i:s', $this->to)->format('H:i');
    }

    public function dateFrom()
    {
        return Date::createFromFormat('H:i:s', $this->from);
    }

    public function dateTo()
    {
        return Date::createFromFormat('H:i:s', $this->to);
    }

    // Relationships
    public function property()
    {
        return $this->belongsTo('App\Models\Property', 'property_id');
    }

}
