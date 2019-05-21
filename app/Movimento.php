<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimento extends Model
{
    //
    protected $fillable = ['data', 'hora_descolagem', 'hora_aterregem', 'aeronave', 'num_diario', 'piloto_id', 'instrutor_id'];

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

        return 'Unknown';
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

    /*public function aeronave(){
        return $this->belongsTo(Aeronave::class, 'aeronave');
    }*/
}
