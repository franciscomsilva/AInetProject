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
    #region aeronave
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
        $this->authorize('create', Aeronave::class);
        $aeronave = new Aeronave();

    
        $aeronave->fill($request->validate());

        storePrecosUnidade($request->preco_hora, $Aeronave->matricula);
        
        $aeronave->save();
        return redirect()
            ->route('aeronaves.index')
            ->with('success', 'Aeronave adicionada com sucesso!');
    }
    #region funcoes auxiliares da tabela de ContaHoras

    private function storePrecosUnidade($precoHora, $matricula){
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

        $precoUnidade = ceil($precoUnidade);
        dd($precoUnidade);
        return $precoUnidade;
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
    public function edit(Aeronave $aeronave)
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
    public function update(StoreAeronaveRequest $request, Aeronave $aeronave)
    {
        $this->authorize('update', $request);
        
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
    public function destroy(Aeronave $aeronave)
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
    #endregion aeronave

    #region aeronave/pilotos
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
        $autorizar = 0;

        return view('aeronaves.pilotos.list', compact('title', 'pilotos', 'aeronave', 'autorizar'));
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

        if ($pilotosDaAeronave->count() == 0)
            $pilotos = User::where('tipo_socio', 'like', 'P')->paginate(15);
        else{
            $pilotos = AeronavePiloto::where('matricula', 'like', $aeronave->matricula)->get('piloto_id');

            $pilotos =  User::where('tipo_socio','like', 'P')->whereNotIn('id', $pilotos)->paginate(15);
        }
        $autorizar = 1;
        
        return view('aeronaves.pilotos.nao-autorizados.list', compact('title', 'pilotos', 'aeronave', 'autorizar'));//compact(['pilotos', 'aeronave']));
    }

    /**
    * .
    * @param Aeronave $aeronave
    * @param User $piloto
    * 
    * @return \Illuminate\Http\Response
    */
    public function autorizarPiloto(Aeronave $aeronave, User $piloto)
    {   
        $aeronavePiloto = AeronavePiloto::where('piloto_id', $piloto->id)->where('matricula', 'like', $aeronave->matricula)->first();
        if ($aeronavePiloto != null) {
            return redirect()
            ->route('aeronaves.pilotosIndex', $aeronave)
            ->with('errors', 'Piloto já se encontra autorizado.');
        }

        $aeronavePiloto = new AeronavePiloto();

        $this->authorize('authorize', $aeronave);
       
        
        $aeronavePiloto->matricula = $aeronave->matricula;
        $aeronavePiloto->piloto_id = $piloto->id;
        
        $aeronavePiloto->save();
        
        ///dd($aeronave, $piloto, $aeronavePiloto);
        
        return redirect()
        ->route('aeronaves.pilotosIndex', $aeronave)
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
        $this->authorize('authorize', $aeronave);

        $aeronavePiloto = AeronavePiloto::where('matricula', 'like', $aeronave->matricula)->where('piloto_id', $piloto->id)->first();

        if ($aeronavePiloto == null) {
            return redirect()
            ->route('aeronaves.pilotosIndex', $aeronave)
            ->with('errors', 'O piloto em causa já não esta autorizado.');
        }
        
        $aeronavePiloto->forceDelete();
        
        return redirect()
        ->route('aeronaves.pilotosIndex', $aeronave)
        ->with('success', 'Revogada autorização de pilotar aeronave.');
    }
    #endregion aeronave/pilotos

    #region precos_tempos
    public function precos_temposIndex(Aeronave $aeronave){
        $precos_tempos = $aeronave->valores()->get();

        return view('aeronaves.precos-tempos', compact('precos_tempos', 'aeronave'));
    }
    #endregion precos_tempos

}
