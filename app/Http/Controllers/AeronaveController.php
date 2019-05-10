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
        $aeronaves = Aeronave::paginate(15);//DB::table('aeronaves')->paginate(15);
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
    public function edit($matricula)
    {
        $aeronave = Aeronave::findOrFail($matricula);
        return view('aeronaves.edit', compact('aeronave'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $aeronave = new Aeronave();
        $aeronave->fill($request->validated());
        $aeronave->save();

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
    public function destroy($id)
    {
        //soft deletes


        //hard deletes
    }

    private function generalSave(UpdateAeronaveRequest $request, $id, $message){
        
        $aeronave = new Aeronave();
        $aeronave->fill($request->validated());

        if (aeronaveExists($aeronave['matricula']))
            return redirect()->route('aeronaves.add')->with('errors', 'Matricula já existe!');

        $aeronave->save();
        return redirect()
            ->route('aeronaves.index')
            ->with('success', $message);
    }


    private function aeronaveExists($matricula){
        $aeronave = Aeronave::findOrFail($matricula);
        return $aeronave != null ? true : false;
    }
}
