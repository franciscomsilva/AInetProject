<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimento extends Model
{
    //
    protected $fillable = [
    ];

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


    public function confirmado(){
        switch ($this->confirmado) {
            case 1:
                return 'checked';
            case 0:
                return '';
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
