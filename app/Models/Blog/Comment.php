<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use Jenssegers\Date\Date;

class Comment extends Model
{
    use SoftDeletes;
    protected $fillable = ['content', 'user_id'];
	protected $table = 'blog_comments';

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function post()
    {
    	return $this->belongsTo(Post::class);
    }

    public function date()
    {
        return Date::createFromFormat('Y-m-d H:i:s', $this->created_at);
    }
}
