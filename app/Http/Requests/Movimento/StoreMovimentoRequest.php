<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovimentoRequest extends FormRequest
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
<<<<<<< HEAD

            'data' => 'required|date',
            'hora_descolagem' => 'required|date',
            'hora_aterragem' => 'required|date|after:hora_descolagem',
            'aeronave' => 'required|exists:aeronaves,matricula',
            'num_diario' => 'required|numeric',
            'num_servico' => 'required|numeric',
            'piloto_id' => 'required|numeric',
            'num_licenca_piloto' => 'required|numeric',
            'validade_licenca_piloto' => 'required|date',
            'tipo_licenca_piloto' => 'required',
            'num_certificado_piloto' => 'required|numeric',
            'validade_certificado_piloto' => 'required|date',
=======
            'data' => 'required|date',
            'hora_descolagem' => 'required|before:hora_aterragem',
            'hora_aterragem' => 'required|after:hora_descolagem',
            'aeronave' => 'required',
            'num_diario' => 'required|numeric|min:0',
            'num_servico' => 'required|numeric|min:0',
            'piloto_id' => 'required|numeric|min:0',
            'num_licenca_piloto' => 'required|numeric|min:0',
            'validade_licenca_piloto' => 'required|date|after_or_equal:data',
            'tipo_licenca_piloto' => 'required',
            'num_certificado_piloto' => 'required|numeric',
            'validade_certificado_piloto' => 'required|date|after_or_equal:data',
>>>>>>> f3b5a81377898d6127de61e4e5945388d250ab8d
            'classe_certificado_piloto' => 'required',
            'natureza' => 'required|in:T,I,E',
            'aerodromo_partida' => 'required',
            'aerodromo_chegada' => 'required',
<<<<<<< HEAD
            'num_aterragens' => 'required|numeric',
            'num_descolagens' => 'required|numeric',
            'num_pessoas' => 'required|numeric',
            'conta_horas_inicio' => 'required|numeric',
            'conta_horas_fim' => 'required|numeric',
=======
            'num_aterragens' => 'required|numeric|min:0',
            'num_descolagens' => 'required|numeric|min:0',
            'num_pessoas' => 'required|numeric|min:0',
            'conta_horas_inicio' => 'required|numeric|max:conta_horas_fim',
            'conta_horas_fim' => 'required|numeric|min:conta_horas_inicio',
>>>>>>> f3b5a81377898d6127de61e4e5945388d250ab8d
            'tempo_voo' => 'required|numeric',
            'preco_voo' => 'required|numeric',
            'modo_pagamento' => 'required|in:N,M,T,P',
            'num_recibo' => 'required',
            'observacoes' => 'nullable|string',
<<<<<<< HEAD
            'confirmado' => 'required|between:0,1',
=======
            'confirmado' => 'between:0,1',
>>>>>>> f3b5a81377898d6127de61e4e5945388d250ab8d
            'tipo_instrucao' => 'nullable',
            'instrutor_id' => 'nullable',
            'num_licenca_instrutor' => 'nullable',
            'validade_licenca_instrutor' => 'nullable',
            'tipo_licenca_instrutor' => 'nullable',
            'num_certificado_instrutor' => 'nullable',
            'validade_certificado_instrutor' => 'nullable',
            'classe_certificado_instrutor' => 'nullable',
<<<<<<< HEAD
            'created_at' => 'required',
            'updated_at' => 'required',
            'tipo_conflito' => 'nullable | in:S,B',
            'justificacao_conflito' => 'nullable'
            ];

=======
            'tipo_conflito' => 'nullable',
            'justificacao_conflito' => 'nullable'
        ];
>>>>>>> f3b5a81377898d6127de61e4e5945388d250ab8d
    }
}
