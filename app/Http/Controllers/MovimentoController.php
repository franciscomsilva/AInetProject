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
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Display a listing of the resource.
     *
     * @param MovimentoFilters $filters
     * @return \Illuminate\Http\Response
     */
    public function index(MovimentoFilters $filters)
    {
        $movimentos = Movimento::filter($filters) ->orderBy('movimentos.id', 'desc')->paginate(15);
        $aeronaves = Aeronave::all();
        //dd($movimentos);
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
        //dd($request);
        //
        $this->authorize('create', Movimento::class);

        $movimento = new Movimento();

        $movimento->fill($request->validated());

        if ($movimento->natureza!='I')
        {
            $movimento->instrutor_id=null;
            $movimento->tipo_instrucao=null;
            $movimento->num_licenca_instrutor=null;
            $movimento->validade_licenca_instrutor=null;
            $movimento->tipo_licenca_instrutor=null;
            $movimento->num_certificado_instrutor=null;
            $movimento->validade_certificado_instrutor=null;
            $movimento->classe_certificado_instrutor=null;
        }
        else {
            if ($movimento->instrutor_id==null){
                return redirect()->back()->withErrors( 'Instrução: Tem que ter o registo do instrutor');
            }

            $instrutor = DB::select('select * from users where id = ? ', [$movimento->instrutor_id]);



            $movimento->num_licenca_instrutor=$instrutor[0]->num_licenca;
            $movimento->validade_licenca_instrutor=$instrutor[0]->validade_licenca;
            $movimento->tipo_licenca_instrutor=$instrutor[0]->tipo_licenca;
            $movimento->num_certificado_instrutor=$instrutor[0]->num_certificado;
            $movimento->validade_certificado_instrutor=$instrutor[0]->validade_certificado;
            $movimento->classe_certificado_instrutor=$instrutor[0]->classe_certificado;
        }

        $movimento->hora_descolagem = $movimento->data.' '.$movimento->hora_descolagem;
        $movimento->hora_aterragem = $movimento->data.' '.$movimento->hora_aterragem;

        $aeronave = DB::select('select * from aeronaves where matricula = ?', [$movimento->aeronave]);

        //$piloto = DB::select('select * from users where id = ? ', [$movimento->piloto_id]);
        $piloto = DB::select('select * from users where id = ? ', [$movimento->piloto_id]);

        $movimento->num_licenca_piloto=$piloto[0]->num_licenca;
        $movimento->validade_licenca_piloto=$piloto[0]->validade_licenca;
        $movimento->tipo_licenca_piloto=$piloto[0]->tipo_licenca;
        $movimento->num_certificado_piloto=$piloto[0]->num_certificado;
        $movimento->validade_certificado_piloto=$piloto[0]->validade_certificado;
        $movimento->classe_certificado_piloto=$piloto[0]->classe_certificado;

        if ($aeronave[0]->num_lugares<$movimento->num_pessoas){
            return redirect()->back()->withErrors( 'Aeronave '.$aeronave[0]->matricula.' pode no máximo levar '.$aeronave[0]->num_lugares.' pessoas');
        }

        $movimentoVerificacao = DB::select('select * from movimentos where aeronave = ? order by id desc LIMIT 1', [$movimento->aeronave]);

        if ($movimentoVerificacao[0]->conta_horas_fim<$movimento->conta_horas_inicio)
        {
            return redirect()->back()->withErrors( 'Conta Horas tem que ser maior do que '.$movimentoVerificacao[0]->conta_horas_fim);
        }

        if ($movimento->piloto_id==$movimento->instrutor_id){
            return redirect()->back()->withErrors( 'Piloto e Instrutor não pode ser a mesma pessoa');
        }

        if ($movimento->conta_horas_inicial>$movimento->conta_horas_final){
            return redirect()->back()->withErrors( 'Conta Horas Inicial tem que ser inferior ao Conta Horas Final');
        }

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
    private function verifyMovimento(Movimento $movimento){}

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function confirmado(Request $request){
        //dd($request);
        //dd(Request()::input());
        $movimentos = Movimento::all();



        /*$typedocs = $request->input('confirmado');
        foreach($typedocs as $ke){
            dd($ke);
        }/*
        foreach ($movimentos as $movimento){
            if ($request->input('confirmado'.$movimento->id)=='checked'){
                dd($movimento);
                //DB::update("update movimentos set confirmado =1 where id = ?",[$movimento->id]);

            }
        }
        return redirect()
            ->route("movimentos.index")
            ->with('success','Movimentos confirmados');*/
    }
}
