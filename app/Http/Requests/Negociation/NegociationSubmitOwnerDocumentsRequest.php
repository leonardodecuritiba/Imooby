<?php

namespace App\Http\Requests\Negociation;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class NegociationSubmitOwnerDocumentsRequest extends FormRequest
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
        return [
            'name'              => 'required|min:3|max:100',
            'email'             => 'required|email|min:3|max:60',
            'iptu_code'         => 'required',
            'iptu_registration' => 'required',
            'cpf'               => 'required|min:3|max:16',
            'civil_status'      => 'required',
            'phone'             => 'required|min:3|max:11',
            'cellphone'         => 'required|min:3|max:11',
            'doc_link'          => 'required|image',
            'cpf_link'          => 'required|image',
            'address_proof_link'=> 'required|image',
        ];
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
