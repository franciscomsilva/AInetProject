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

        <button type="submit" class="btn btn-success" name="search">Pesquisar</button>
    </form>
    @can('create', App\User::class)
        <div>
            <a class="btn btn-primary" href="{{route('user.create')}}">Adicionar sócio</a>
        </div>
        <br>
    @endcan
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
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                @if($user->ativo)
                <tr>
                    <td><img src="{{ $user->foto_url == null ? asset('storage/fotos/unknown_user.jpg') : asset('storage/fotos/' . $user->foto_url)}}" class="img-thumbnail"/> </td>
                    <td>{{$user->name}}</td>
                    <td> {{ $user->email }}</td>
                    <td>{{ $user->tSocioToString()}}</td>
                    <td>{{$user->nrLicencaToString()}}</td>
                    <td>{{$user->direcaoToString()}}</td>
                    <td>
                        @can('update', $user)
                            <a class="btn btn-xs btn-primary" href="{{route('user.edit', $user)}}">Editar</a>
                        @endcan
                    </td>
                </tr>
                @endif
            @endforeach
        </table>

        {{$users->links()}}

    @else

        <h2>No users found</h2>

    @endif


</div>
@endsection

