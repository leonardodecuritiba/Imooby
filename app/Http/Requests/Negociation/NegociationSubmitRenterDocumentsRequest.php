<?php

namespace App\Http\Requests\Negociation;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class NegociationSubmitRenterDocumentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('client')) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(!Request::has('update')){
            return [
                'document.*.name'               => 'required|min:3|max:100',
                'document.*.email'              => 'required|email|min:3|max:60',
                'document.*.cpf'                => 'required|min:3|max:16',
                'document.*.civil_status'       => 'required',
                'document.*.phone' => 'required|min:3|max:14',
                'document.*.cellphone' => 'required|min:3|max:14',
                'document.*.income_nature'      => 'required',
                'document.*.gross_income'       => 'required',
                'document.*.reason'             => 'required',

                'document.*.doc_link'           => 'required|image',
                'document.*.cpf_link'           => 'required|image',
                'document.*.address_proof_link' => 'required|image',
                'document.*.income_proof_link'  => 'required|image',
            ];
        }
        return [];
    }

    /**
     * Get the response that handle the request errors.
     *
     * @param  array $errors
     * @return array
     */
    public function response(array $errors)
    {
//        $content = [
//            'code' => 0,
//            'status' => $errors
//        ];
//        return new JsonResponse($content, 422);
        return Redirect::back()->withErrors($errors)->withInput();
    }
}
