@extends('layouts.app')

@section('title', 'Pilotos')

@section('content')
@can('create', App\User::class)
    <div>
        <a class="btn btn-primary" href="{{route('aeronaves.pilotoAdd', $aeronave, $user)}}">Adicionar Piloto</a>
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
                @if($user->ativo && $user->tipo_socio = "P")
                <tr>
                    <td><img src="{{ $user->foto_url == null ? asset('storage/fotos/unknown_user.jpg') : asset('storage/fotos/' . $user->foto_url)}}" class="img-thumbnail"/> </td>
                    <td>{{$user->name}}</td>
                    <td> {{ $user->email }}</td>
                    <td>{{ $user->tSocioToString()}}</td>
                    <td>{{$user->nrLicencaToString()}}</td>
                    <td>{{$user->direcaoToString()}}</td>
                    <td>
                        @can('delete', $user)
                            <a class="btn btn-xs btn-primary" href="{{route('aeronaves.pilotoDestroy', $user)}}">Editar</a>
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

