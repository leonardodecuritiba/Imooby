<?php

namespace App\Http\Requests;

use App\Models\Property;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class BlogPostRequest extends FormRequest
{
    private $table = 'blog_posts';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(!isset($this->to_update)) {
            return [
                'title' => 'required|min:5|max:128',
                'category' => 'required|exists:blog_categories,id',
                'show_image' => 'required|image',
                'content'=>'required',
                'description'=>'required|max:160'
            ];
        } else {
            return [
                'title' => 'required|min:5|max:128',
                'category' => 'required|exists:blog_categories,id',
                'content'=>'required',
                'description'=>'required|max:160'
            ];
        }
    }

    /**
     * Get the response that handle the request errors.
     *
     * @param  array $errors
     * @return array
     */
    public function response(array $errors)
    {
        return Redirect::back()->withErrors($errors)->withInput();
    }
}
