<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AeronaveValor extends Model
{
    //

    protected $fillable = [
        'matricula',
        'unidade_conta_horas',
        'minutos',
        'preco'
    ];

    protected $table = 'aeronaves_valores';
    protected $primaryKey = 'id';
    public $incrementing = true;

    public function aeronaves() {
        return $this->belongsTo('App\Aeronave', 'matricula');
    }
}
