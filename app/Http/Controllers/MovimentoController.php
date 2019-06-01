<?php

namespace App\Http\Controllers;

use App\Aerodromo;
use App\Aeronave;
use App\ClasseCertificado;
use App\Filters\MovimentoFilters;
use App\Http\Requests\Movimento\UpdateMovimentoRequest;
use App\Http\Requests\StoreMovimentoRequest;
use App\Movimento;
use App\TipoLicenca;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Compound;

class MovimentoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param MovimentoFilters $filters
     * @return \Illuminate\Http\Response
     */
    public function index(MovimentoFilters $filters)
    {
        $movimentos = Movimento::filter($filters) ->orderBy('id', 'desc')->paginate(15);
        $aeronaves = Aeronave::all();

        return view('movimentos.list', compact( ['movimentos', 'aeronaves']));
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
        $tipoLicencas = TipoLicenca::all();
        $movimento = new Movimento();
        $classesCertificados = ClasseCertificado::all();
        return view('movimentos.add', compact(['movimento','pilotos', 'aeronaves', 'aerodromos', 'tipoLicencas', 'classesCertificados']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMovimentoRequest $request)
    {


        $this->authorize('create', Movimento::class);
        $movimento = new Movimento();
        $movimento->fill($request->validated());

        $this->verificaConflitos($movimento);



        $movimento = new Movimento();
        $movimento->fill($request->validated());
        $movimento->save();


        return redirect()
            ->route('movimentos.index')
            ->with('success', 'Movimento adicionado com sucesso!');
    }

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
     * @param \App\Movimento $movimento
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Movimento $movimento)
    {
        //
        $this->authorize('update', $movimento);
        $aeronaves = Aeronave::all();
        $pilotos = User::all();
        $tipoLicencas = TipoLicenca::all();
        $aerodromos = Aerodromo::all();
        $classesCertificados = ClasseCertificado::all();
        return view('movimentos.edit', compact(['movimento', 'pilotos', 'aeronaves', 'aerodromos', 'tipoLicencas','classesCertificados']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movimento  $movimento
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMovimentoRequest $request, Movimento $movimento)
    {
        $this->authorize('update', $movimento);
/*
        if (!(Auth::user()->id==$request->id_piloto || Auth::user()->id==$request->id_instrutor)){
            return redirect()
                ->route('users.create')
                ->with('erros', 'erro');
        }*/

       // $movimento->fill($request->all());
       $movimento->fill($request->validated()); 
       $movimento->save();

        return redirect()
            ->route('users.index')
            ->with('success', 'Movimento updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Movimento $movimento
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Movimento $movimento)
    {
        $this->authorize('delete', $movimento);

        if ($movimento->confirmado==0){
            $movimento->delete();
            return redirect()
                ->route('movimentos.index')
                ->with('success', 'Movimento apagado com sucesso!!');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function confirma(Request $request){

        $movimentos = Movimento::all();
        foreach ($movimentos as $movimento){
            if (dd($request->has('confirmado'.$movimento->id))){
                DB::update("update movimentos set confirmado =1 where id = ?",[$movimento->id]);
            }
        }
        return redirect()
            ->route("movimentos.index")
            ->with('success','Movimentos confirmados');
    }


    /**
     * @param Movimento $movimento
     */
    public function verificaConflitos(Movimento $movimento){

        dd($movimento->aeronave);
       $movimentos = DB::table('movimentos')->where('aeronave','=',$movimento->matricula)->get();

       dd($movimentos);
    }




    /*private function validateDestroy(Movimento $movimento){
        $deleted = DB::table('movimentos')->where([
            ['id', '=', $movimento->id],
            ['confirmado', '<>', '1']])->delete();

    }*/
}
