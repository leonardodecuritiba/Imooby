<?php

namespace App\Http\Requests;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class AdminRequest extends FormRequest
{
    private $table = 'admins';

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
        $Data = Admin::find($this->admin);
        $id = count($Data) ? $Data->id : 0;
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'name' => 'required|min:5|max:100',
                    'email' => 'unique:users,email',
                    'email' => 'required|min:5|max:60',
                    'password' => 'required|min:5|max:60',
                ];

            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => 'required|min:5|max:100',
                    'email' => 'required|min:5|max:100|unique:users,email,' . $Data->user->id . ',id',
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
