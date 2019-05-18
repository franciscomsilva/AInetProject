<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aerodromo extends Model
{
    protected $fillable = [
        'code', 'nome', 'militar', 'ultraleve'
    ];

    protected $table = 'aerodromos';
}
