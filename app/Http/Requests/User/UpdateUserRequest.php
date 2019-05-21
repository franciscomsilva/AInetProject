<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'num_socio' => 'unique:users|integer|min:1|max:99999',
            'nome_informal' => 'required',
            'email' => 'required|email',
            'sexo' => 'in:M,F',
            'tipo_socio' => 'in:P,NP,A',
            'data_nascimento' => 'date|before:today',
            'nif' => 'required|integer|digits:9',
            'telefone' => 'required|min:9|max:14',
            'endereco' => 'required',
            'num_licenca' => 'required',
            'tipo_licenca' => 'required',
            'validade_licenca' => 'required |date|after:today|',
            'instrutor' => 'between:0,1',
            'licenca_confirmada' => 'between:0,1',
            'classe_certificado' => '',
            'validade_certificado' => 'required |date|after:today|',
            'certificado_confirmado' => 'between:0,1',
            'ativo' => 'between:0,1',
            'quota_paga' => 'between:0,1',
            'direcao' => 'between:0,1'

        ];
    }
}
