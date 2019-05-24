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
        
        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'alpha_dash' => 'O campo :attribute só pode conter letras e números.',
            'max' => 'O valor máximo do campo :attribute é :value.',
            'min' => 'O valor mínimo do campo :attribute é :value.',
            'numeric' => 'O campo :attribute só pode conter numeros.',
            'unique' => 'A :attribute já existe, escolha outra.',
        ];
        return $messages;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'matricula' => 'required|alpha_dash|max:8|min:6|unique:aeronaves',
            'marca' => 'required|alpha_dash|max:40',
            'modelo' => 'required|alpha_dash|max:40',
            'num_lugares' => 'required|numeric|min:0',
            'conta_horas' => 'required|numeric|min:0',
            'preco_hora' => 'required|numeric|min:0',
        ];
    }
}
