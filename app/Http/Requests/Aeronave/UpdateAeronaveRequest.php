<?php

namespace App\Http\Requests\Aeronave;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;

class UpdateAeronaveRequest extends FormRequest
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
        $aeronave = Route::current()->parameter('aeronave');
        return [
            'matricula' => [
                'required','alpha_dash','between:6,8',Rule::unique('aeronaves')->ignore($aeronave->matricula, 'matricula'),
            ],
            'marca' => 'required|alpha_dash|string|between:0,40',
            'modelo' => 'required|alpha_dash|string|between:0,40',
            'num_lugares' => 'required|numeric|integer|min:1',
            'conta_horas' => 'required|numeric|integer|min:1',
            'preco_hora' => 'required|numeric|min:1',
            'precos' => 'array',
        ];
    }
}
