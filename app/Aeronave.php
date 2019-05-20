<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aeronave extends Model
{
    protected $fillable = [
        'matricula', 'marca', 'modelo', 'num_lugares', 'conta_horas', 'preco_hora'
    ];

    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
     protected $casts = [
        'deleted_at' => 'datetime',
    ];

    protected $table = 'aeronaves';
    protected $primaryKey = 'matricula';
    public $incrementing = false;


    public function pilotos(){
        return $this->belongsToMany('App\User','aeronaves_pilotos','matricula','piloto_id');
    }

    public function valores(){
       // return $this->belongsToMany('App\Aeronave', 'aeronaves_valores', '');
    }

}
