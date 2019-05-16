<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Aeronave;

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
        $title = 'List Aeronaves';
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAeronaveRequest $request)
    {
        $this->authorize('create', Aeronave::class);
    
        $aeronave = new Aeronave();
        $aeronave->fill($request->validate());
        
        if (Aeronave::findOrFail(($aeronave['matricula'])) != null) {
            return redirect()
            ->route('aeronaves.add')
            ->with('errors', 'Matricula já existe!');
        }else{
            $aeronave->save();
            return redirect()
                ->route('aeronaves.index')
                ->with('success', 'Aeronave adicionada com sucesso!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Aeronave  $aeronave
     * @return \Illuminate\Http\Response
     */
    public function edit($aeronave)
    {
        $this->authorize('update', $aeronave);
        
        //$aeronave = Aeronave::findOrFail($matricula);
        return view('aeronaves.edit', compact('aeronave'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $aeronave)
    {
        $this->authorize('update', $aeronave);
        /*
        $aeronave = new Aeronave();
        $aeronave->fill($request->validated());
        $aeronave->save();*/

        generalSave($request, $aeronave);

        return redirect()
            ->route('aeronaves.index')
            ->with('success', 'Aeronave atualizada com sucesso!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($aeronave)
    {
        $this->authorize('delete', Aeronave::class);
        
        //soft deletes


        //hard deletes só para os duros mesmo!
        $aeronave->delete();
        return redirect()
            ->route('aeronaves.index')
            ->with('success', 'Aeronave eliminada com sucesso.');
    }



    private function aeronaveExists($matricula){
        $aeronave = Aeronave::findOrFail($matricula);
        return $aeronave != null ? true : false;
    }
}
