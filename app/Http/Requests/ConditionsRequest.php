<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class ConditionsRequest extends FormRequest
{
    private $table = 'conditions';

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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'title' => 'required|min:3|max:100',
                    'description' => 'required|min:3|max:1000',
                    'order' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'title' => 'required|min:3|max:100',
                    'description' => 'required|min:3|max:1000',
                    'order' => 'required',
                ];
            }
            default:
                break;
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
