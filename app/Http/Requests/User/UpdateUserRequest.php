<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class UpdateUserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $user = Route::current()->parameter('user');
        return [
            'name' => 'required',
            'num_socio' => ['required','min:1','max:99999',Rule::unique('users')
                ->ignore($user->num_socio,'num_socio')],
            'nome_informal' => 'required',
            'email' => ['required','email',Rule::unique('users')
                ->ignore($user->email,'email')],
            'sexo' => 'in:M,F',
            'tipo_socio' => 'in:P,NP,A',
            'data_nascimento' => 'date|before:today',
            'nif' => 'required|integer|digits:9',
            'telefone' => 'required|min:9|max:14',
            'endereco' => 'required',
            'num_licenca' => '',
            'tipo_licenca' => '',
            'validade_licenca' => 'date|after:today|',
            'instrutor' => 'between:0,1',
            'licenca_confirmada' => 'between:0,1',
            'classe_certificado' => '',
            'validade_certificado' => 'date|after:today|',
            'certificado_confirmado' => 'between:0,1',
            'ativo' => 'between:0,1',
            'quota_paga' => 'between:0,1',
            'direcao' => 'between:0,1',
            'classe_socio' => 'in:N,C,M,H'

        ];
    }
}
