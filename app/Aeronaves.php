<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aeronaves extends Model
{
    //
    use SoftDeletes;

    protected $primaryKey = 'matricula';
    public $incrementing = false;
    protected $table = 'aeronaves';
}
