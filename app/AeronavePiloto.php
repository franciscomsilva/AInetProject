<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AeronavePiloto extends Model
{
    //
    protected $fillable = [
        'matricula',
        'piloto_id'
    ];

    protected $table = 'aeronaves_pilotos';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

}
