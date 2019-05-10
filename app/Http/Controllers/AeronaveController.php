<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Aeronave;

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
    public function storeUpdate(Request $request)
    {

        $this->validate($request, [
            'matricula' => 'required|alpha_dash|min:8|max:8',
            'marca' => 'required|alpha_dash',
            'modelo' => 'required|alpha_dash',
            'num_lugares' => 'required|min:0',
            'conta_horas' => 'required',
            'preco_hora' => 'required',
        ]);

        $aeronave = new Aeronave();
        $aeronave->fill($request->all());
        $aeronave->save();

        return redirect()
            ->route('aeronaves.index')
            ->with('success', 'Aeronave adicionada com sucesso!');
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
    public function validateAddUpdate($matricula){
        $aeronaves = Aeronave::all();

        $aeronaves->find($matricula);


    }
}
