<?php

namespace App;

use Illuminate\Database\Eloquent\Model, Illuminate\Database\Eloquent\SoftDeletes;

class Aeronave extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'matricula', 'marca', 'modelo', 'num_lugares', 'conta_horas', 'preco_hora'
    ];

    protected $table = 'aeronaves';
    protected $primaryKey = 'matricula';
    public $incrementing = false;


    public function pilotos(){
        return $this->belongsToMany('App\User','aeronaves_pilotos','matricula','piloto_id');
    }

    public function movimentos(){
        return $this->hasMany('App\Movimento', 'aeronave', 'matricula');

    }

    public function valores(){
        return $this->hasMany('App\AeronaveValor', 'matricula');
    }
    
    public function hasMovimentos(Aeronave $aeronave){
        // usar um ou outro... finde procura pelo id
        //$movimentos = Movimento::find($aeronave['matricula']);
        $movimentos = Movimento::where('aeronave', '%like%', $aeronave['matricula']);
        return $movimentos->count() > 0 ? true : false;
    }

}
