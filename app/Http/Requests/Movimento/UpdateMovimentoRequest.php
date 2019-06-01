<?php

namespace App\Http\Requests\Movimento;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovimentoRequest extends FormRequest
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
            'after' => 'A data tem de ser depois de',
            'hora_descolagem.before' => 'A Hora de Descolagem tem de ser inferior à Hora de Aterragem',
            'hora_aterragem.after' => 'A Hora de Aterragem tem de ser superior à Hora de Descolagemm',
            'conta_horas_inicio.max' => 'O Conta Horas Final tem de ser superior ao Conta Horas Inicial.',
            'conta_horas_fim.min' => 'O Conta Horas Inicial tem de ser inferior ao Conta Horas Final.',
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
            'classe_certificado_piloto' => 'required',
            'natureza' => 'required|in:T,I,E',
            'aerodromo_partida' => 'required',
            'aerodromo_chegada' => 'required',
            'num_aterragens' => 'required|numeric',
            'num_descolagens' => 'required|numeric',
            'num_pessoas' => 'required|numeric',
            'conta_horas_inicio' => 'required|numeric|max:conta_horas_fim',
            'conta_horas_fim' => 'required|numeric|min:conta_horas_inicio',
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
