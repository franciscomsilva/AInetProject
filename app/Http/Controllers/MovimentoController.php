<?php

namespace App\Http\Controllers;

use App\Aerodromo;
use App\Aeronave;
use App\Movimento;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Compound;

class MovimentoController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movimentos = Movimento::paginate(15);
        $title = 'List Movimentos';
        return view('movimentos.list', compact('title', 'movimentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Movimento::class);
        $aeronaves = Aeronave::all();
        $pilotos = User::all();
        $aerodromos = Aerodromo::all();
        $movimento = new Movimento();
        return view('movimentos.add', compact(['movimento','pilotos', 'aeronaves', 'aerodromos']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //$this->authorize('create', Movimento::class);

        /*$movimento = new Movimento();
        $movimento->fill($request->all());
        $movimento->save();

        return redirect()
            ->route('movimentos.index')
            ->with('success', 'Movimento adicionado com sucesso!');
    */}

    /**
     * Display the specified resource.
     *
     * @param  \App\Movimento  $movimento
     * @return \Illuminate\Http\Response
     */
    public function show(Movimento $movimento)
    {
        return view('movimentos.show', compact('movimento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movimento  $movimento
     * @return \Illuminate\Http\Response
     */
    public function edit(Movimento $movimento)
    {
        //
        $this->authorize('update', $movimento);
        $aeronaves = Aeronave::all();
        $pilotos = User::all();
        $aerodromos = Aerodromo::all();
        return view('movimentos.edit', compact(['movimento', 'pilotos', 'aeronaves', 'aerodromos']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movimento  $movimentos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movimento $movimentos)
    {
        //$this->authorize('update', $movimento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movimento  $movimento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movimento $movimento)
    {
        //$this->authorize('delete', $movimento);
        $errors = [];
        if ($movimento->confirmado==0){
            $movimento->delete();
            return redirect()
                ->route('movimentos.index')
                ->with('success', 'Movimento apagado com sucesso!!');
        }
        else{
            $errors[0]="Erro";
            return redirect()
                ->route('movimentos.index');

        }
    }

    /*private function validateDestroy(Movimento $movimento){
        $deleted = DB::table('movimentos')->where([
            ['id', '=', $movimento->id],
            ['confirmado', '<>', '1']])->delete();

    }*/
}
