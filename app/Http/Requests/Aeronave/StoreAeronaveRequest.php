<?php

namespace App\Http\Requests\Aeronave;

use Illuminate\Foundation\Http\FormRequest;

class StoreAeronaveRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'matricula' => 'required|alpha_dash|max:8|min:6',
            'marca' => 'required|alpha_dash|max:40',
            'modelo' => 'required|alpha_dash|max:40',
            'num_lugares' => 'required|numeric|min:0',
            'conta_horas' => 'required|numeric|min:0',
            'preco_hora' => 'required|numeric|min:0',
        ];
    }
}
