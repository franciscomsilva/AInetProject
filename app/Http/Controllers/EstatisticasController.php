<?php

namespace App\Http\Controllers;

use App\Aeronave;
use App\Movimento;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use \Khill\Lavacharts\Lavacharts as Lava;

class EstatisticasController extends Controller
{
    public function estatisticas(){

        $users = User::all()->where('tipo_socio','=','P');
        $aeronaves = Aeronave::all();
        return view('movimentos.estatisticas',compact(['users','aeronaves']));
    }

    public function getEstatisticas(Request $request){

        $users = User::all()->where('tipo_socio','=','P');
        $aeronaves = Aeronave::all();

        $user = User::where('id','=',$request->piloto_id)->first();
        $aeronave = Aeronave::where('matricula','=',$request->aeronave_matricula)->first();

        if($user == null|| $aeronave == null){
            return view('movimentos.estatisticas',compact('users','aeronaves'))
                ->with('errors',new MessageBag(['Por favor selecione uma aeronave e um piloto!']));

        }



        $lava = new Lava;

        /*MOVIMENTOS DO PILOTO*/

        /*OBTEM TEMPO TOTAL VOO POR MES*/
        $movimentosTempoPiloto = DB::table('movimentos')
            ->select(DB::raw('SUM(tempo_voo) as tempo_total'),DB::raw('YEAR(data) as ano'))
            ->where('piloto_id','=',$user->id)->groupBy('ano')->get();

        $movimentosTempoVooPiloto = $lava->DataTable();

        $movimentosTempoVooPiloto->addNumberColumn('ano')
            ->addNumberColumn($user->nome_informal);

        foreach($movimentosTempoPiloto->toArray() as $movimento){
            $movimentosTempoVooPiloto->addRow([$movimento->ano, $movimento->tempo_total]);
        }


        /*MOVIMENTOS DA AERONAVE*/

        $movimentosTempoAeronave = DB::table('movimentos')
            ->select(DB::raw('SUM(tempo_voo) as tempo_total'),DB::raw('MONTH(data) as mes'))
            ->where('aeronave','=',$aeronave->matricula)->groupBy('mes')->get();

        $movimentosTempoVooAeronave = $lava->DataTable();

        $movimentosTempoVooAeronave->addNumberColumn('mes')
            ->addNumberColumn($aeronave->matricula);

        foreach($movimentosTempoAeronave->toArray() as $movimento){
            $movimentosTempoVooAeronave->addRow([$movimento->mes, $movimento->tempo_total]);
        }

        /*CRIACAO DOS GRAFICOS*/

           $lava->LineChart('Movimentos do Piloto', $movimentosTempoVooPiloto, [
            'title' => 'Horas de Voo do Piloto '.$user->nome_informal,
            'axisTitlesPosition' => 'Ano',
            'curveType'          => 'string',
            'hAxis'              => ['title'=>'Ano','format'=>'####'],
            'vAxis'              => ['title'=>'Horas de Voo'],
            'interpolateNulls'   => true,
            'lineWidth'          => 1,
            'pointSize'          => 1,
        ]);

        $lava->LineChart('Movimentos da Aeronaves', $movimentosTempoVooAeronave, [
            'title' => 'Horas de Voo da Aeronave '.$aeronave->matricula,
            'axisTitlesPosition' => 'Ano',
            'curveType'          => 'string',
            'hAxis'              => ['title'=>'Mês','format'=>'####'],
            'vAxis'              => ['title'=>'Horas de Voo'],
            'interpolateNulls'   => true,
            'lineWidth'          => 1,
            'pointSize'          => 1,
        ]);


        return view('movimentos.estatisticas',compact('lava','users','aeronaves'));
    }
}
