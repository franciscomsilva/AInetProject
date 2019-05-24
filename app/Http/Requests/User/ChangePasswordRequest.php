<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class ChangePasswordRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'old_password' => 'required',
            'password' => 'required|min:8|max:20',
            'password_conf' => 'required|same:password'
        ];


    }


    public function messages()
    {
        return [
            'old_password.required' => 'Por favor introduza a password original!',
            'password.required' => 'Por favor introduza a nova password!',
            'password_conf.required' => 'Por favor introduza a confirmação da nova password!',
            'password_conf.same' => 'As passswords não correspondem!',
            'password.min' => 'A password nova tem de ter no mínimo 8 carateres!',
            'password.max' => 'A password nova só pode ter um maimo de 20 carateres!'
        ];
    }
}
