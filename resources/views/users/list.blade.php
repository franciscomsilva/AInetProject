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
                    @if($user->foto_url)
                        <td><img src="/storage/fotos/{{$user->foto_url}}" height="50px" width="50x" />   </td>
                    @else
                        <td><img src="/storage/fotos/unknown_user.jpg" height="50px" width="50px" />   </td>
                    @endif
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

