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

    
        $aeronave->fill($request->validated());
        //dd($aeronave);
        $aeronave->save();

        //calcula os precos por unidade_hora da aeronave.
        $aeronave->storePrecosUnidade($aeronave->preco_hora, $aeronave->matricula);
        
        return redirect()
            ->route('aeronaves.index')
            ->with('success', 'Aeronave adicionada com sucesso!');
    }

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
        $this->authorize('update', $aeronave);

        if ($aeronave->matricula != $request->matricula) {
            $aeronave->fill($request->only('matricula'));
        }
        if ($aeronave->marca != $request->marca) {
            $aeronave->fill($request->only('marca'));
        }
        if ($aeronave->modelo != $request->modelo) {
            $aeronave->fill($request->only('modelo'));
        }
        if ($aeronave->num_lugares != $request->num_lugares) {
            $aeronave->fill($request->only('num_lugares'));
        }
        if ($aeronave->conta_horas != $request->conta_horas) {
            $aeronave->fill($request->only('conta_horas'));
        }
        if ($aeronave->preco_hora != $request->preco_hora) {
            $aeronave->fill($request->only('preco_hora'));
            $aeronave->storePrecosUnidade($request->preco_hora, $aeronave->matricula);
        }
        
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
        $this->authorize('delete', Aeronave::class);
        
        if ($aeronave->hasMovimentos($aeronave)){
            $aeronave->delete(); // soft delete
        }else{
            $this->authorize('forceDelete', Aeronave::class);
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
