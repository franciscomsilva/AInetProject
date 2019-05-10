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

        {{ $users->links() }}


    @else

        <h2>No users found</h2>

    @endif


</div>
@endsection

