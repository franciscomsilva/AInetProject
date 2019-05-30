<?php

namespace App\Http\Controllers;

use App\Filters\UserFilters;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Movimento;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param UserFilters $filters
     * @return \Illuminate\Http\Response
     */

    public function index(UserFilters $filters)
    {

        $users = User::filter($filters)->paginate();

        return view('users.list', compact( 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', User::class);
        $user = new User;
        return view('users.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('create',User::class);
        $user = new User;

        /*VERIFICACAO DA FOTO DO UTILIZADOR*/
        if(! is_null($request['image'])) {


            $image = $request->file('image');
            $name = $user->id . '_' . generateRandomString(13) . '.' . $image->getClientOriginalExtension();
            $path = $request->file('image')->storeAs('public/fotos', $name);


            /*GUARDA O NOME DO FICHEIRO*/
            $user->foto_url = $name;
        }

        /*VERIFICACAO DA LICENCA DO UTILIZADOR*/
        if(!is_null($request['licenca'])) {
            $name = 'licenca_' . $user->id . '.pdf';

            /*UPLOAD DA LICENCA*/
            $path = $request->file('licenca')->storeAs('docs_piloto', $name);
        }

        /*VERIFICACAO DO CERTIFICADO DO UTILIZADOR*/
        if(!is_null($request['certificado'])) {
            $name = 'certificado_' . $user->id . '.pdf';

            /*UPLOAD DO CERTIFICADO*/
            $path = $request->file('certificado')->storeAs('docs_piloto', $name);
        }

        /*RESOLVE O PROBLEMA DAS CHECKBOXES*/

        if(!$request->get('instrutor'))
            $user->instrutor = 0;

        if(!$request->get('ativo')){
            $this->authorize('mudarEstado',$user);
            $user->ativo = 0;
        }

        if(!$request->get('quota_paga'))
            $user->quota_paga = 0;

        if(!$request->get('direcao')) {
            $this->authorize('mudarDirecao', $user);
            $user->direcao = 0;

        }

        if(!$request->get('licenca_confirmada')){
            $this->authorize('confirmLicenca',$user);
            $user->licenca_confirmada = 0;
        }

        if(!$request->get('certificado_confirmado')){
            $this->authorize('confirmCertificado',$user);
            $user->certificado_confirmado = 0;
        }


        /*DEFINE A PASSWORD COMO DATA DE NASCIMENTO*/
        $user->password = Hash::make($request->data_nascimento);

        /*METE PASSWORD INICIAL A 1*/
        $user->password_inicial = 1;

        $user->fill($request->validated());

        /*RESETAR OS CAMPOS QUANDO NAO E PILOTO*/
        if($user->tipo_socio != 'P'){
            $user->tipo_licenca = null;
            $user->classe_certificado = null;
        }

        /*MANDA EMAIL DE VERIFICACAO*/
        $user->sendEmailVerificationNotification();


        $user->save();

        return redirect()
            ->route('user.index')
            ->with('success', 'Utilzador adicionado com sucesso!');

    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function show(User $user)
    {
        $this->authorize('view',$user);
        return view('users.view', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Ressponse
     * @throws AuthorizationException
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return void
     * @throws AuthorizationException
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        /*VERIFICACAO DA FOTO DO UTILIZADOR*/
        if(! is_null($request['image'])) {
            /*APAGA A IMAGEM ANTERIOR DO UTILIZADOR*/
            Storage::Delete("public/fotos/" . $user->foto_url);


            $image = $request->file('image');
            $name = $user->id . '_' . generateRandomString(13) . '.' . $image->getClientOriginalExtension();
            $path = $request->file('image')->storeAs('public/fotos', $name);

            /*GUARDA O NOME DO FICHEIRO*/
            $user->foto_url = $name;
        }

        /*VERIFICACAO DA LICENCA DO UTILIZADOR*/
        if(!is_null($request['licenca'])) {
            $name = 'licenca_' . $user->id . '.pdf';

            /*APAGA QUAISQUER LICENÇA ANTERIORES*/
            Storage::Delete("docs_piloto/" . $name);

            /*UPLOAD DA LICENCA*/
            $path = $request->file('licenca')->storeAs('docs_piloto', $name);
        }

        /*VERIFICACAO DO CERTIFICADO DO UTILIZADOR*/
        if(!is_null($request['certificado'])) {
            $name = 'certificado_' . $user->id . '.pdf';

            /*APAGA QUAISQUER CERTIFICADOS ANTERIORES*/
            Storage::Delete("docs_piloto/" . $name);

            /*UPLOAD DO CERTIFICADO*/
            $path = $request->file('certificado')->storeAs('docs_piloto', $name);
        }


        /*RESOLVE O PROBLEMA DAS CHECKBOXES*/

        if(!$request->get('instrutor'))
            $user->instrutor = 0;

        if(!$request->get('ativo')){
            $this->authorize('mudarEstado',$user);
            $user->ativo = 0;
        }

        if(!$request->get('quota_paga'))
            $user->quota_paga = 0;

        if(!$request->get('direcao')){
            $this->authorize('mudarDirecao',$user);
            $user->direcao = 0;
        }

        if(!$request->get('licenca_confirmada')){
            $this->authorize('confirmLicenca',$user);
            $user->licenca_confirmada = 0;
        }

        if(!$request->get('certificado_confirmado')){
            $this->authorize('confirmCertificado',$user);
            $user->certificado_confirmado = 0;
        }




        /*VERIFICAÇÃO SE OS CAMPOS RELATIVOS À LICENCA FORAM ALTERADOS*/
        if($request->get('num_licenca') != $user->num_licenca || $request->get('tipo_licenca') != $user->tipoLicenca->toString()
        || $request->get('validade_licenca') != $user->validade_licenca || $request->get('instrutor') != $user->instrutor ){
            $user->licenca_confirmada = 0;
        }



        /*VERIFICAÇÃO SE OS CAMPOS RELATIVOS AO CERTIFICADO MÉDICO FORAM ALTERADOS*/
        if($request->get('num_certificado') != $user->num_certificado || $request->get('classe_certificado') != $user->classeCertificado->toString()
        || $request->get('validade_certificado') != $user->validade_certificado){
            $user->certificado_confirmado = 0;
        }






        $user->fill($request->validated());

        $user->save();

        return redirect()
            ->route('user.index')
            ->with('success', 'Utilzador editado com sucesso!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return void
     * @throws AuthorizationException
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $this->authorize('delete',User::class);

        /*SOFT DELETE*/
        if($user->movimentos() != null){
            $user->delete();

            /*HARD DELETE*/
        }else {
            $this->authorize('forceDelete',User::class);
            $user->forceDelete();
        }

    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws AuthorizationException
     */
    public function reenviarEmail(User $user){
        $this->authorize('enviarEmail',User::class);
        $user->sendEmailVerificationNotification();

        return redirect()
            ->route('user.edit',$user)
            ->with('success', 'Email enviado com sucesso!');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws AuthorizationException
     */
    public function resetQuotas(){
        $this->authorize('resetQuotas',User::class);

        User::where('quota_paga',1)->update(['quota_paga' => 0]);

        return redirect()
                ->route('user.index')
                ->with('success', 'Quotas resetadas com sucesso!');
    }

    public function desativarSQuotas(){
        $this->authorize('resetQuotas',User::class);

        User::where('quota_paga',0)->update(['ativo' => 0]);

        return redirect()
            ->route('user.index')
            ->with('success', 'Utilizadores com quota por pagar desativados com sucesso!');

    }

    /**
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws AuthorizationException
     */
    public function getCertificado(User $user){
        $this->authorize('getCertificado',$user);

        $path = 'certificado_'.$user->id . '.pdf';

        if(file_exists(storage_path('app/docs_piloto/'. $path)))
            return response()->file(storage_path('app/docs_piloto/'. $path));

        return redirect()->route('user.edit',$user)->with('errors',new MessageBag(['Sócio não possui certificado!']));
    }

    /**
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws AuthorizationException
     */
    public function getLicenca(User $user){
        $this->authorize('getLicenca',$user);

        $path = 'licenca_'.$user->id . '.pdf';

        if(file_exists(storage_path('app/docs_piloto/'. $path)))
            return response()->file(storage_path('app/docs_piloto/'. $path));

        return redirect()->route('user.edit',$user)->with('errors',new MessageBag(['Sócio não possui licença!']));
    }

    public function estado(User $user){
        if($user == null){
            User::where('quota_paga',0)->update(['ativo' => 0]);
        }

        $this->authorize('mudarEstado',$user);

        $user->ativo = $user->ativo == 1 ? 0 : 1;
        $user->save();

        return redirect()
            ->route('user.index')
            ->with('success', 'Estado do utilizador mudado com sucesso!');
    }

    public function quota(User $user){

        $user->quota_paga = $user->quota_paga == 1 ? 0 : 1;
        $user->save();

        return redirect()
            ->route('user.index')
            ->with('success', 'Estado da quota do utilizador mudado com sucesso!');
    }

    public function password(){
        return view('password');
    }

    /**
     * @param ChangePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(ChangePasswordRequest $request){

        $user = Auth::user();

        if(!Hash::check($request->get('old_password'),$user->password)){
            return redirect()
                ->route('user.password')
                ->with('errors',new MessageBag(['Password antiga não corresponde!']));
        }

       $user->fill($request->validated());
        $user->password = Hash::make($user->password);

        /*SE FOR PRIMEIRA VEZ A ALTERAR PASSWORD METE CAMPO PASSWORD ORIGINAL A 0*/
        if($user->password_inicial)
            $user->password_inicial = 0;

        $user->save();

        return redirect()
            ->route('user.show',$user)
            ->with('success','Password alterada com sucesso!');

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws AuthorizationException
     */
    public function pendentes(){
        $this->authorize('viewPendentes',Auth::user());

        /*VAI BUSCAR TODOS OS MOVIMENTOS NAO CONFIRMADOS E COM CONFLITO*/
        $movimentos = Movimento::where('confirmado','=',0)->OrwhereNotNull('tipo_conflito')->get();
        $users = User::where('licenca_confirmada','=',0)->OrWhere('certificado_confirmado','=',0)->get();

        $pendentes = array_merge($movimentos->toArray(),$users->toArray());

        return view('users.pendentes',compact('pendentes'));

    }

}
