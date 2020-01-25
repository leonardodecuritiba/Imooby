<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogCategoryRequest;
use App\Http\Requests\BlogPostRequest;
use Illuminate\Http\Request;
use App\Models\Blog\Comment;
use App\Models\Blog\Category;
use App\Models\Blog\Post;

class BlogController extends Controller
{
    function __construct()
    {
        return $this->middleware('auth')->only(['comment']);
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->simplePaginate(15);
        $posts_paginate = $posts;
        return view('site.blog.index', compact(['posts', 'posts_paginate']));
    }

    public function show($category, $title)
    {
        if ($post = Post::findByTitle($title)) {
            $page_description = $post->description;
            return view('site.blog.show', compact('post', 'page_description'));
        }
            return abort(404);
    }

    public function showCategory($category)
    {
        if ($category = Category::findByTitle($category)) {
            $posts = $category->posts()->orderBy('created_at', 'DESC')->simplePaginate(15);
            $posts_paginate = $posts;
            return view('site.blog.index', compact(['posts', 'posts_paginate']));
        }
        abort(404);
    }

    public function searchPost()
    {
        if(isset($_GET['q'])) {
            $posts = Post::search($_GET['q'])->get();
            $posts_paginate = '';
            $emptyPosts = false;
            if (empty($posts->all())) {
                $emptyPosts = true;
            }
            return view('site.blog.index', compact(['posts', 'posts_paginate', 'emptyPosts']));
        }
        abort(404);
    }
    // User
    public function comment(Request $request)
    {
        if ($post = Post::find($request->post_id)) {
            $this->validate($request, [
                'content'=>'required'
            ]);
            $post->comments()->create([
                'content'=>$request->content,
                'user_id'=>\Auth::user()->id
            ]);
            return redirect()->back();
        }
        abort(404);
    }
    // Admin
    public function adminIndex()
    {
        return view('site.blog.adminIndex');
    }

    public function createPost()
    {
        return view('site.blog.createPost');
    }

    public function createCategory()
    {
        return view('site.blog.createCategory');
    }

    public function editCategory($id)
    {
        if ($category = Category::find($id)) {
            return view('site.blog.editCategory', compact(['category']));
        }
        abort(404);
    }

    public function editPost($id)
    {
        if ($post = Post::find($id)) {
            return view('site.blog.editPost', compact(['post']));
        }
        abort(404);
    }

    public function storePost(BlogPostRequest $request)
    {
        $post = \Auth::user()->posts()->create([
            'title'=>$request->title,
            'content'=>$request->content,
            'description'=>$request->description,
            'url'=>str_slug($request->title),
            'image_path'=>'',
            'category_id'=>$request->category]);
        $file = $request->file('show_image');
        $filename = $post->id.'_'.$file->getClientOriginalName();
        $image_path = '/images/blog';
        $file->move(public_path().$image_path, $filename);
        $post->update(['image_path'=>$image_path.'/'.$filename]);
        return redirect()->route('blog.index');
    }

    public function updatePost(BlogPostRequest $request)
    {   
        if($post = Post::find($request->post_id)) {
            if($post->title != $request->title) {
                $post->update(['url'=>str_slug($request->title)]);
            }
            $post->update([
            'title'=>$request->title,
            'content'=>$request->content,
            'description'=>$request->description,
            'category_id'=>$request->category]);
            
            return redirect($post->url());
        }
        abort(404);
    }

    public function storeCategory(BlogCategoryRequest $request)
    {
        Category::create([
            'name'=>$request->name,
            'url'=>str_slug($request->name)
        ]);
        return redirect()->route('blog.index');
    }

    public function updateCategory(BlogCategoryRequest $request)
    {
        if($category = Category::find($request->category_id)) {
            $category->update([
            'name'=>$request->name,
            'url'=>str_slug($request->name)
        ]);
            return redirect($category->url());
        }
        abort(404);
    }

    public function deleteCategory(BlogCategoryRequest $request)
    {
        if($category = Category::find($request->category_id)) {
            $category->posts()->delete();
            $category->delete();
            return redirect()->back();
        }
        abort(404);
    }

    public function deletePost($id)
    {
        if($post = Post::find($id)) {
            $post->delete();
            return redirect()->back();
        }
        return abort(404);
    }

    public function postPhoto(Request $request, $id)
    {
        if($post = Post::find($id)) {
            $file = $request->file('file');
            $filename = $post->id.'_'.$file->getClientOriginalName();
            $image_path = '/images/blog';
            $file->move(public_path().$image_path, $filename);
            $post->update(['image_path'=>$image_path.'/'.$filename]);
            return 1;
        }
        return 'Não foi possivel enviar a foto';
    }

}
