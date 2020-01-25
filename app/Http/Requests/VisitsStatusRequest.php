<?php

namespace App\Http\Requests;

use App\Models\VisitsStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class VisitsStatusRequest extends FormRequest
{
    private $table = 'visits_statuses';

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
        $Data = VisitsStatus::find($this->visits_status);
        $id = count($Data) ? $Data->id : 0;
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'description' => 'required|min:3|max:100|unique:' . $this->table . ',description',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'description' => 'required|min:3|max:100|unique:' . $this->table . ',description,' . $id . ',id',
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
