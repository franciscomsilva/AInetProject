@extends('layouts.app')

@section('title','Sócios')

@section('content')
    <form action="{{URL::Current()}}">
        <input
                    type="number" class="form-control"
                    name="nrSocio"
                    placeholder="Nº de Sócio"/>
        <input
                type="text" class="form-control"
                name="nome"
                placeholder="Nome Informal"/>
        <input
                type="text" class="form-control"
                name="email"
                placeholder="E-Mail"/>

        <input type="radio" name="tSocio" value="P">Piloto
        <input type="radio" name="tSocio" value="NP">Não-Piloto
        <input type="radio" name="tSocio" value="A">Aeromodelista
        <br>

        <input
                type="checkbox"
                name="direcao"
                value="1"/>Direção<br>

        @can('viewAtivo',App\User::class)
            <input
                    type="checkbox"
                    name="ativo"
                    value="1"/>Sócio Ativo<br>
        @endcan
        @can('viewQuota',App\User::class)
            <input
                    type="checkbox"
                    name="quotaPaga"
                    value="1"/>Quotas em Dia<br>
        @endcan

        <button type="submit" class="btn btn-success" name="search">Pesquisar</button>
    </form>
    @can('create', App\User::class)
        <div>
            <a class="btn btn-primary" href="{{route('user.create')}}">Adicionar sócio</a>
        </div>

    @endcan
    <br>
<div class="container">
    @if (count($users))
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Foto</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Tipo de Sócio</th>
                <th>Nº de licença</th>
                <th>Membro da Direção</th>
                <th>
                    @can('viewAtivo',App\User::class)
                        Sócio Ativo
                    @endcan
                </th>
                <th>
                    @can('viewQuota',App\User::class)
                        Quotas em Dia
                    @endcan
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                        <td><img src="{{ $user->foto_url == null ? asset('storage/fotos/unknown_user.jpg') : asset('storage/fotos/' . $user->foto_url)}}" height="50px" width="50px" class="img-thumbnail"/> </td>
                        <td>{{$user->name}}</td>
                        <td> {{ $user->email }}</td>
                        <td>{{ $user->tSocioToString()}}</td>
                        <td>{{$user->nrLicencaToString()}}</td>
                        <td>{{$user->direcaoToString()}}</td>
                        <td>
                            @can('viewAtivo',App\User::class)
                                {{$user->ativoToString()}}
                            @endcan
                        </td>
                        <td>
                            @can('viewQuota',App\User::class)
                                {{$user->quotasToString()}}
                            @endcan
                        </td>
                        <td>
                            @can('viewAtivo',$user)
                                <form action="{{route('user.ativo',$user)}}" method="post" class="form-group">
                                    {{ method_field('PATCH') }}
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-xs btn-primary" name="ok">Ativar/Desativar</button>
                                    </div>
                                </form>
                            @endcan
                                @can('viewQuota',$user)
                                    <form action="{{route('user.quota',$user)}}" method="post" class="form-group">
                                        {{ method_field('PATCH') }}
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-xs btn-primary" name="ok">Paga/Por pagar</button>
                                        </div>
                                    </form>
                                @endcan
                            @can('update', $user)
                                <a class="btn btn-xs btn-primary" href="{{route('user.edit', $user)}}">Editar</a>
                            @endcan
                            @can('view',$user)
                                    <a class="btn btn-xs btn-primary" href="{{route('user.show', $user)}}">Ver</a>
                                @endcan
                        </td>
            @endforeach
        </table>

        {{$users->links()}}

    @else

        <h2>No users found</h2>

    @endif


</div>
@endsection

