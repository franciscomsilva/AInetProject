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
    /*public function authorize()
    {
        return false;
    }*/

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
            'data' => 'required|date',
            'hora_descolagem' => 'required|datetime',
            'hora_aterragem' => 'required|datetime',
            'aeronave' => 'required|exists:aeronave,matricula',
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
            'confirmado' => 'required|between:0,1',
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
            'tipo_conflito' => 'nullable | in:S,B',
            'justificacao_conflito' => 'nullable'];
    }
}
