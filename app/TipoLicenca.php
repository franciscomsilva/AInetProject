<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoLicenca extends Model
{
    protected $table = 'tipos_licencas';
    protected $primaryKey = 'code';

    public function pilotos(){
        return $this->hasMany('App\User');
    }

    public function toString(){
        switch($this->nome){
            case 'Aluno - Private Pilot License Airplane':
                return 'ALUNO-PPL(A)';
            case 'Aluno - Piloto de Ultraleve':
                return 'ALUNO-PU';
            case 'Airline Transport Pilot License':
                return 'ATPL';
            case 'Comercial Pilot License Airplane':
                return 'CPL(A)';
            case 'Private Pilot License Airplane':
                return 'PPL(A)';
            case 'Piloto de Ultraleve':
                return 'PU';

        }
        return 'Unknown';
    }


}
