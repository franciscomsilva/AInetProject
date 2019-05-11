<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aeronave extends Model
{
    protected $fillable = [
        'matricula', 'marca', 'modelo', 'num_lugares', 'conta_horas', 'preco_hora'
    ];

    protected $table = 'aeronaves';
    protected $primaryKey = 'matricula';
    public $incrementing = false;

}
