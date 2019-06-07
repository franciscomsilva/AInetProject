<?php

namespace App\Http\Controllers;

use App\Aerodromo;
use App\Http\Requests\UpdateAerodromoRequest;
use Illuminate\Http\Request;

class AerodromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aerodromos = Aerodromo::paginate();
        return view('aerodromos.list',compact('aerodromos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aerodromo  $aerodromo
     * @return \Illuminate\Http\Response
     */
    public function show(Aerodromo $aerodromo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aerodromo  $aerodromo
     * @return \Illuminate\Http\Response
     */
    public function edit(Aerodromo $aerodromo)
    {
        return view('aerodromos.edit',compact('aerodromo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aerodromo  $aerodromo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAerodromoRequest $request, Aerodromo $aerodromo)
    {
        $aerodromo->fill($request->validated());
        $aerodromo->militar = $aerodromo->ultraleve = 0;
        $aerodromo->save();

        return redirect()
            ->route('aerodromo.index')
            ->with('success', 'Aerodromo editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aerodromo  $aerodromo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aerodromo $aerodromo)
    {
        //
    }
}
