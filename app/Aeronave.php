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
        return $this->hasMany('App\Movimento', 'matricula');

    }

    public function valores(){
        return $this->hasMany('App\AeronaveValor', 'matricula');
    }
    
    public function hasMovimentos(Aeronave $aeronave){
        $movimentos = Movimento::where('aeronave', 'like', $aeronave['matricula'])->get();
        return $movimentos->count() > 0 ? true : false;
    }


    #region funcoes auxiliares da tabela de ContaHoras
    public function storePrecosUnidade($request){
        $aeronavesValores = AeronaveValor::where('matricula', 'like', $request->matricula)->get();
        if ($aeronavesValores->count() == 0) { // creates precos for aeronave
            for ($i = 0; $i < 10; $i++) {
                $aeronaveValor = new AeronaveValor();

                $aeronaveValor->minutos = $this->roundContaHoras($i+1);
                $aeronaveValor->preco = $this->roundPrecoUnidade($request->precoHora, $i);
                $aeronaveValor->unidade_conta_horas = $i+1;
                $aeronaveValor->matricula = $request->matricula;
                $aeronaveValor->save();
            }
        } else {
            $j = 0;
            foreach ($aeronavesValores as $aeronaveValor) {
                
                
                $aeronaveValor->minutos = $request->minutos[$j];
                $aeronaveValor->preco = $request->precos[$j];
                // $aeronaveValor->unidade_conta_horas = $i;
                //$aeronaveValor->matricula = $request->matricula;
                
                $aeronaveValor->save();
                $j++;
            }
        }
    }

    private function roundPrecoUnidade($precoHora, $conta_hora){
        $precoUnidade = $precoHora * $conta_hora / 10;

        $precoUnidade = ceil($precoUnidade);
        
        return $precoUnidade;
    }

    public function roundContaHoras($unidade){
        switch ($unidade) {
            case 1:
                return 5;
            case 2:
                return 10;
            case 3:
                return 20;
            case 4:
                return 25;
            case 5:
                return 30;
            case 6:
                return 35;
            case 7:
                return 40;
            case 8:
                return 50;
            case 9:
                return 55;
            case 10:
                return 60;
            default:
                return $unidade*6;
        }
    }
    #endregion funcoes tabela de ContaHoras


}
