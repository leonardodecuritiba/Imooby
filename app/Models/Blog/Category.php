<?php

namespace App\Models\Blog;

use App\Helpers\DataHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'url'];
    protected $table = 'blog_categories';

    public function url()
    {
        return url('/blog/'.$this->urlTitle());
    }

    public function urlTitle()
    {
        if (empty($this->url)) {
            $this->update(['url'=>str_slug($this->name)]);
        }
        return $this->url;
    }

    public static function getAll()
    {
        return Category::orderBy('name')->get();
    }

    public function posts()
    {
    	return $this->hasMany(Post::class, 'category_id');		
    }

    public static function findByTitle($title)
    {
        if($category = Category::where('url', $title)->first()) {
            return $category;
        }
        return false;
    }
}
