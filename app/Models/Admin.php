<?php

namespace App\Models;

use App\Helpers\DataHelper;
use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $fillable = [
        'iduser',
        'idphoto',
        'name',
    ];

    public function getCreatedAtAttribute($value)
    {
        return DataHelper::getPrettyDateTime($value);
    }


    public function getShortName()
    {
        $name = explode(' ', trim($this->name));
        return $name[0]; // will print Test
    }

    public function getPhoto()
    {
        $photo = $this->photo;
        return ($photo != NULL) ? asset(ImageHelper::PATH_NAME) . '/admins/' . $photo->link : asset('admin/imgs/user.png');
    }

    public function getThumbPhoto()
    {
        $photo = $this->photo;
        return ($photo != NULL) ? asset(ImageHelper::PATH_NAME) . '/admins/thumb_' . $photo->link : asset('admin/imgs/user.png');
    }

    // ******************** RELASHIONSHIP ******************************
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'iduser');
    }

    public function photo()
    {
        return $this->belongsTo('App\Models\Photo', 'idphoto');
    }
}
