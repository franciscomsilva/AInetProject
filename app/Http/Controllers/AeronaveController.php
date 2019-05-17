<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Aeronave;
use App\User;


use App\Http\Requests\Aeronave\CreateAeronaveResquest;
use App\Http\Requests\Aeronave\StoreAeronaveResquest;

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
        $this->authorize('create', Aeronave::class);
    
        $aeronave = new Aeronave();
        $aeronave->fill($request->validate());
        
        if (Aeronave::findOrFail($aeronave['matricula']) != null) {
            return redirect()
            ->route('aeronaves.add')
            ->with('errors', 'Matricula já existe!');
        }
        $aeronave->save();
        return redirect()
            ->route('aeronaves.index')
            ->with('success', 'Aeronave adicionada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  string $matricula
     * @return \Illuminate\Http\Response
     */
    public function show($matricula)
    {
        // sera que é mesmo preciso ?
        //return view('aeronave.profile', ['aeronave' => Aeronave::findOrFail($matricula)]);
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
        
        $aeronave = new Aeronave();
        $aeronave->fill($request->validate());
        
        if (Aeronave::findOrFail(($aeronave['matricula'])) != null) {
            return redirect()
            ->route('aeronaves.add')
            ->with('errors', 'Matricula já existe!');
        }
        $aeronave->save();
        return redirect()
            ->route('aeronaves.index')
            ->with('success', 'Aeronave adicionada com sucesso!');
    
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  Aeronave $aeronave
     * @return \Illuminate\Http\Response
     */
    public function destroy($aeronave)
    {
        $this->authorize('delete', Aeronave::class);
        
        if (count($aeronave->movimentos) > 0)
            $aeronave->delete(); // soft delete
        $aeronave->forceDelete(); //hard delete
        
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
    */
    public function pilotosIndex(Aeronave $aeronave)
    {
        $title = 'Pilotos da Aeronave';
        $pilotos = $aeronave->pilotos()->paginate(15);

        return view('aeronaves.pilotos.list', compact('title', 'pilotos'));
    }


}
