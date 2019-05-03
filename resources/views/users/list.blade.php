@extends('layouts.app')

@section('title','Sócios')

@section('content')
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
                <tr>
                    <td><img src="/storage/fotos/{{$user->foto_url}}" height="30px" width="30px" />   </td>
                    <td>{{$user->name}}</td>
                    <td> {{ $user->email }}</td>
                    <td>{{ $user->tSocioToString()}}</td>
                    <td>{{$user->nrLicencaToString()}}</td>
                    <td>{{$user->direcaoToString()}}</td>
                </tr>
            @endforeach
        </table>

        {{ $users->links() }}


    @else

        <h2>No users found</h2>

    @endif


</div>
@endsection
