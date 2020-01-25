<?php

namespace App\Models;

use App\Notifications\MyResetPassword;
use App\Notifications\ScheduleCreated;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use \App\Models\Blog\Post;
use \App\Models\Blog\Comment;

class User extends Authenticatable
{
//    use SoftDeletes;
    use Notifiable;
    use EntrustUserTrait; // add this trait to your user model

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'status', 'social_media_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
 
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyResetPassword($token));
    }

    public function disactivate()
    {
        return $this->update(['status' => 0]);
    }

    public function activate()
    {
        return $this->update(['status' => 1]);
    }

    public function changePwd($data)
    {
        return $this->update(['password' => bcrypt($data['password'])]);
    }

    public function getPhone()
    {
        return ($this->client != null ? $this->client->contact->cellphone : '');
    }

    public function isAdmin()
    {
        if($this->admin != null) {
            return true;
        }
        return false;
    }

    public function getThumbPhoto()
    {
        $Admin = $this->admin;
        return ($Admin != NULL) ? $Admin->getThumbPhoto() : $this->client->getThumbPhoto();
    }

    public function getFullName()
    {
        $Admin = $this->admin;
        return ($Admin != NULL) ? $Admin->name : $this->client->name;
    }

    public function getShortName()
    {
        $Admin = $this->admin;
        return ($Admin != NULL) ? $Admin->getShortName() : $this->client->getShortName();
    }

    public function getIntercomAuth()
    {
        return hash_hmac('sha256', $this->email, 'E9yJbNxals4QTKnTgNJu3-iy9kfQ1OpqBvslN75s');
    }
    // ******************** RELASHIONSHIP ******************************

    public function admin()
    {
        return $this->hasOne('App\Models\Admin', 'iduser');
    }

    public function client()
    {
        return $this->hasOne('App\Models\Client', 'iduser');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
