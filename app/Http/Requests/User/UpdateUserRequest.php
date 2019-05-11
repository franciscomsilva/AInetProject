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
            'nome_informal' => 'required',
            'email' => 'required|email',
            'data_nascimento' => 'date|before:today',
            'nif' => 'required|integer|digits:9',
            'telefone' => 'required|integer|digits:9',
            'endereco' => 'required'


        ];
    }
}
