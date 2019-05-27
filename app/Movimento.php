<?php

namespace App;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Movimento extends Model
{
    use Filterable;
    //
    protected $fillable = ['id','data','hora_descolagem','hora_aterragem','aeronave','num_diario','num_servico','piloto_id','num_licenca_piloto',
        'validade_licenca_piloto','tipo_licenca_piloto','num_certificado_piloto','validade_certificado_piloto', 'classe_certificado_piloto', 'natureza', 'aerodromo_partida',
        'aerodromo_chegada', 'num_aterragens', 'num_descolagens', 'num_pessoas', 'conta_horas_inicio', 'conta_horas_fim', 'tempo_voo', 'preco_voo', 'modo_pagamento', 'num_recibo',
        'observacoes', 'confirmado', 'tipo_instrucao', 'instrutor_id', 'num_licenca_instrutor', 'validade_licenca_instrutor', 'tipo_licenca_instrutor', 'num_certificado_instrutor',
        'validade_certificado_instrutor', 'classe_certificado_instrutor', 'created_at', 'updated_at', 'tipo_conflito', 'justificacao_conflito'];

    protected $table = 'movimentos';

    public function naturezaMovimentoToString(){
        switch ($this->natureza) {
            case 'T':
                return 'Treino';
            case 'I':
                return 'Instrução';
            case 'E':
                return 'Especial';
        }

        return 'Unknown';
    }

    public function tipoInstrucaoToString(){
        switch ($this->tipo_instrucao) {
            case 'D':
                return 'Duplo Comando';
            case 'S':
                return 'Solo';
        }

        return '';
    }

    public function modoPagamentoToString(){
        switch ($this->modo_pagamento) {
            case 'N':
                return 'Numerário';
            case 'M':
                return 'Multibanco';
            case 'T':
                return 'Transferência';
            case 'P':
                return 'Pacote de Horas';
        }

        return 'Unknown';
    }


    public function confirmado(){
        switch ($this->confirmado) {
            case 1:
                return 'checked';
            case 0:
                return '';
        }

        return 'Unknown';
    }
  
    public function confirmadoToString(){
        switch ($this->confirmado) {
            case 1:
                return 'Sim';
            case 0:
                return 'Não';
        }

        return 'Unknown';
    }

    public function piloto(){
        return $this->belongsTo('App\User','piloto_id');
    }

    public function instrutor(){
        return $this->belongsTo('App\User','instrutor_id');
    }

    public function aeronave(){
        return $this->belongsTo('App\Aeronave', 'matricula');
    }
}
