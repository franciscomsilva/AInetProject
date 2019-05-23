<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Aeronave;
use App\AeronavePiloto;
use App\AeronaveValor;
use App\User;
use Illuminate\Database\Eloquent\Model as Eloquent;

use App\Http\Requests\Aeronave\CreateAeronaveRequest;
use App\Http\Requests\Aeronave\StoreAeronaveRequest;

class AeronaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aeronaves = Aeronave::paginate(15);
        $title = 'Aeronaves';
        return view('aeronaves.list', compact('title', 'aeronaves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Aeronave::class);

        $aeronave = new Aeronave();
        return view('aeronaves.add', compact('aeronave'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateAeronaveRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAeronaveRequest $request)
    {
        $aeronave = new Aeronave();

        $this->authorize('create', $aeronave);
    
        $aeronave->fill($request->validate());

        calculaTabelaPrecos($request->preco_hora, $Aeronave->matricula);
        
        $aeronave->save();
        return redirect()
            ->route('aeronaves.index')
            ->with('success', 'Aeronave adicionada com sucesso!');
    }
    #region funcoes tabela de ContaHoras

    private function calculaTabelaPrecos($precoHora, $matricula){
        for ($i = 1; $i <= 10; $i++){
            $aeronaveValor = new AeronaveValor();
            
            $aeronaveValor->minutos = roundContaHoras($i);
            $aeronaveValor->preco = roundPrecoUnidade($precoHora, $aeronaveValor->minutos);
            $aeronaveValor->unidade_conta_horas = $i;
            $aeronaveValor->matricula = $matricula;

            $aeronaveValor->save();
        }
    }

    private function roundPrecoUnidade($precoHora, $minutos){
        $precoUnidade = $precoHora * $minutos / 60;

        dd(ceil($precoUnidade));
    }

    private function roundContaHoras($unidade){
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param Aeronave $aeronave
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($aeronave)
    {
        $this->authorize('update', $aeronave);

        return view('aeronaves.edit', compact('aeronave'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreAeronaveRequest $request
     * @param Aeronave $aeronave
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(StoreAeronaveRequest $request, $aeronave)
    {
        $this->authorize('update', $aeronave);
        
        //$aeronave = new Aeronave();
        $aeronave->fill($request->validated());
        
        /*if (Aeronave::findOrFail(($aeronave['matricula'])) != null) {
            return redirect()
            ->route('aeronaves.add')
            ->with('errors', 'Matricula já existe!');
        }*/
        $aeronave->save();
        return redirect()
            ->route('aeronaves.index')
            ->with('success', 'Aeronave atualizada com sucesso!');
    
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  Aeronave $aeronave
     * @return \Illuminate\Http\Response
     */
    public function destroy($aeronave)
    {
        $this->authorize('delete', $aeronave);
        
        if ($aeronave->hasMovimentos()){
            $aeronave->delete(); // soft delete
        }else{
            $aeronave->forceDelete(); //hard delete
        }
        
        return redirect()
            ->route('aeronaves.index')
            ->with('success', 'Aeronave eliminada com sucesso.');
    }


    //---------------------------------- pilotos idnex, adicionar piloto e remover piloto -------------------------
    /**
    * Display a listing of pilots of the plane.
    * @param Aeronave $aeronave
    * 
    * @return \Illuminate\Http\Response
    **/
    public function pilotosIndex(Aeronave $aeronave)
    {
        $this->authorize('authorize', $aeronave);

        $title = 'Pilotos da Aeronave';
        $pilotos = $aeronave->pilotos()->paginate(15);

        return view('aeronaves.pilotos.list', compact('title', 'pilotos', 'aeronave'));
    }
    /**
    * Display a listing of NON autorized pilots of the plane.
    * @param Aeronave $aeronave
    * 
    * @return \Illuminate\Http\Response
    */
    public function pilotosNaoAutorizadosIndex(Aeronave $aeronave)
    {
        $this->authorize('authorize', $aeronave);

        $title = 'Pilotos não autorizados da Aeronave';

        $pilotosDaAeronave = $aeronave->pilotos()->get();
       
        $pilotos =  User::where('tipo_socio','like', 'P')->where('id', '<>', $pilotosDaAeronave)->paginate(15);
        //dd($pilotosDaAeronave);
        //dd($pilotosDaAeronave, $pilotos);
        
        
        return view('aeronaves.pilotos.nao-autorizados.list', compact('title', 'pilotos', 'aeronave'));//compact(['pilotos', 'aeronave']));
    }

    //------------------------------- modificar isto
    /**
    * .
    * @param Aeronave $aeronave
    * @param User $piloto
    * 
    * @return \Illuminate\Http\Response
    */
    public function autorizarPiloto(Aeronave $aeronave, User $piloto)
    {
        $aeronavePiloto = new AeronavePiloto();

        $this->authorize('authorize', $aeronavePiloto);
        


        $aeronavePiloto->matricula = $aeronave->matricula;
        $aeronavePiloto->piloto_id = $piloto->id;
        
        dd($aeronave, $piloto, $aeronavePiloto);

        $aeronavePiloto->save();

        return redirect()
        ->route('aeronaves.pilotosIndex')
        ->with('success', 'Piloto autorizado.');
    }

    
    /**
    * 
    * @param Aeronave $aeronave
    * @param User $piloto
    * 
    * @return \Illuminate\Http\Response
    */
    public function removerPiloto(Aeronave $aeronave, User $piloto)
    {

        $aeronavePiloto = AeronavePiloto::where('matricula', 'like', $aeronave->matricula)->where('piloto_id', $piloto->id)->get();


        $this->authorize('authorize', $aeronavePiloto);
        
        dd($aeronavePiloto, $piloto);
        
        $aeronavePiloto->delete();
        
        return redirect()
        ->route('aeronaves.pilotosIndex')
        ->with('success', 'Revogada autorização de pilotar aeronave.');
    }

    public function precos_temposIndex(Aeronave $aeronave){
        

        $precos_tempos = $aeronave->valores()->get();

        return view('aeronaves.precos-tempos', compact('precos_tempos'));
    }


}
