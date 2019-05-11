<?php

namespace App\Http\Controllers;

use App\Movimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movimentos = Movimento::paginate(15);
        $title = 'List Movimentos';
        //return view('user.list', ['users' => $users]);
        return view('movimentos.list', compact('title', 'movimentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //$this->authorize('create', User::class);

        $movimento = new Movimento();
        return view('movimentos.add', compact('movimento'));
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
     * @param  \App\Movimento  $movimentos
     * @return \Illuminate\Http\Response
     */
    public function show(Movimento $movimentos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movimento  $movimentos
     * @return \Illuminate\Http\Response
     */
    public function edit(Movimento $movimentos)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movimento  $movimentos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movimento $movimentos)
    {
        //
    }
}
