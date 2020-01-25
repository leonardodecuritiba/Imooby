<?php

namespace App\Models\Blog;
// php artisan scout:import App\Models\Blog\Post
use Jenssegers\Date\Date;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use App\Models\User;

class Post extends Model
{
    use Searchable;
    use SoftDeletes;
    protected $fillable = ['title', 'content', 'description', 'url', 'image_path', 'category_id'];
    protected $table = 'blog_posts';


    public function url()
    {
        return url('/blog/'.$this->category->urlTitle().'/'.$this->urlTitle());
    }

    public function urlTitle()
    {
        if (empty($this->url)) {
            $this->update(['url'=>str_slug($this->title)]);
        }
        return $this->url;
    }

    public function contentWithoutHtml($max_length)
    {
        return str_limit(strip_tags($this->content), $max_length);
    }

    public function shortTitle()
    {
        return str_limit($this->title, 30);
    }

    public function formatedDate()
    {
        Date::setLocale('pt_BR');
        return Date::createFromFormat('Y-m-d H:i:s', $this->created_at)->toDayDateTimeString();
    }

    public function image()
    {
        return asset($this->image_path);
    }

    public static function findByTitle($title)
    {
        if($post = Post::where('url', $title)->first()) {
            return $post;
        }
        return false;
    }

    // Relationships
    public function category()
    {
    	return $this->belongsTo(Category::class, 'category_id');		
    }
    
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function toSearchableArray()
    {
        return [
             'id' => $this->id,
             'title' => $this->title,
             'content' => $this->content
        ];
    }
}
