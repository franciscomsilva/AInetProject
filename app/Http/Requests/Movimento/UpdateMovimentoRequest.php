<?php

namespace App\Http\Requests\Movimento;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovimentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /*public function authorize()
    {
        return false;
    }*/

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'data' => 'required|date',
            'hora_descolagem' => 'required|datetime',
            'hora_aterragem' => 'required|datetime',
            'aeronave' => 'required',
            'num_diario' => 'required|numeric',
            'num_servico' => 'required|numeric',
            'piloto_id' => 'required|numeric',
            'num_licenca_piloto' => 'required|numeric',
            'validade_licenca_piloto' => 'required|date',
            'tipo_licenca_piloto' => 'required',
            'num_certificado_piloto' => 'required|numeric',
            'validade_certificado_piloto' => 'required|date',
            'classe_certificado_piloto' => 'required',
            'natureza' => 'required|in:T,I,E',
            'aerodromo_partida' => 'required',
            'aerodromo_chegada' => 'required',
            'num_aterragens' => 'required|numeric',
            'num_descolagens' => 'required|numeric',
            'num_pessoas' => 'required|numeric',
            'conta_horas_inicio' => 'required|numeric',
            'conta_horas_fim' => 'required|numeric',
            'tempo_voo' => 'required|numeric',
            'preco_voo' => 'required|numeric',
            'modo_pagamento' => 'required|in:N,M,T,P',
            'num_recibo' => 'required',
            'observacoes' => 'nullable|string',
            'confirmado' => 'between:0,1',
            'tipo_instrucao' => 'nullable',
            'instrutor_id' => 'nullable',
            'num_licenca_instrutor' => 'nullable',
            'validade_licenca_instrutor' => 'nullable',
            'tipo_licenca_instrutor' => 'nullable',
            'num_certificado_instrutor' => 'nullable',
            'validade_certificado_instrutor' => 'nullable',
            'classe_certificado_instrutor' => 'nullable',
            'tipo_conflito' => 'nullable',
            'justificacao_conflito' => 'nullable'
        ];
    }
}
