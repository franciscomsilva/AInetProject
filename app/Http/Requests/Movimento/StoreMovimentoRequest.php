<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovimentoRequest extends FormRequest
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
            'data' => 'required|date',
            'hora_descolagem' => 'required|',
            'hora_aterragem' => 'required',
            'aeronave' => 'required',
            'num_diario' => 'required',
            'num_servico' => 'required',
            'piloto_id' => 'required',
            'num_licenca_piloto' => 'required',
            'validade_licenca_piloto' => 'required',
            'tipo_licenca_piloto' => 'required',
            'num_certificado_piloto' => 'required',
            'validade_certificado_piloto' => 'required',
            'classe_certificado_piloto' => 'required',
            'natureza' => 'in:T,I,E',
            'aerodromo_partida' => 'required',
            'aerodromo_chegada' => 'required',
            'num_aterragens' => 'numeric',
            'num_descolagens' => 'numeric',
            'num_pessoas' => 'numeric',
            'conta_horas_inicio' => 'numeric',
            'conta_horas_fim' => 'numeric',
            'tempo_voo' => 'numeric',
            'preco_voo' => 'numeric',
            'modo_pagamento' => 'in:N,M,T,P',
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
            'created_at' => 'required',
            'updated_at' => 'required',
            'tipo_conflito' => 'required',
            'justificacao_conflito' => 'required'];
    }
}
