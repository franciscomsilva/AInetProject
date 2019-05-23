<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Aeronave;
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
     * @param  StoreAeronaveRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAeronaveRequest $request)
    {
        $aeronave = new Aeronave();

        $this->authorize('create', $aeronave);
    
        $aeronave->fill($request->validate());
        
        $aeronave->save();
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
        $pilotos =  User::where('tipo_socio','like', 'P')->paginate(15);
        
        //dd($pilotos);
        
        return view('aeronaves.pilotos.nao-autorizados.list', compact(['pilotos', 'aeronave']));
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
        $this->authorize('authorize', $piloto);
        dd($aeronave, $piloto);
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
        $this->authorize('authorize', $piloto);
        
        dd($aeronave, $piloto);
        return redirect()
        ->route('aeronaves.pilotosIndex')
        ->with('success', 'Revogada autorização de pilotar aeronave.');
    }
}
