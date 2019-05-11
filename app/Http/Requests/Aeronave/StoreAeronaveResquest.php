<?php

namespace App\Http\Requests\Aeronave;

use Illuminate\Foundation\Http\FormRequest;

class StoreAeronaveResquest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'matricula' => 'required|alpha_dash|size:8|only',
            'marca' => 'required|alpha_dash',
            'modelo' => 'required|alpha_dash',
            'num_lugares' => 'required|min:0',
            'conta_horas' => 'required',
            'preco_hora' => 'required',
        ];
    }
}
