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
}
