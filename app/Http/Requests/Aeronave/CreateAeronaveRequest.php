<?php

namespace App\Http\Requests\Aeronave;

use Illuminate\Foundation\Http\FormRequest;

class CreateAeronaveRequest extends FormRequest
{
    /**
     * Get the messages for the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages(){
        
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'alpha_dash' => 'O campo :attribute só pode conter letras e números.',
            'max' => 'O valor máximo do campo :attribute é :value.',
            'min' => 'O valor mínimo do campo :attribute é :value.',
            'numeric' => 'O campo :attribute só pode conter numeros.',
            'unique' => 'A :attribute já existe, escolha outra.',
        ];
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'matricula' => 'required|alpha_dash|string|max:8|min:6|unique:aeronaves',
            'marca' => 'required|alpha_dash|string',
            'modelo' => 'required|alpha_dash|string',
            'num_lugares' => 'required|numeric|integer|min:2',
            'conta_horas' => 'required|numeric|integer|min:1',
            'preco_hora' => 'required|numeric|min:10',
        ];
    }
}
