@extends('layouts.app')

@section('title', 'Pilotos')

@section('content')
<div class="container">
    @if (count($pilotos))
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
            @foreach($pilotos as $piloto)
                @if($piloto->ativo && $piloto->tipo_socio = "P")
                <tr>
                    <td><img src="{{ $piloto->foto_url == null ? asset('storage/fotos/unknown_user.jpg') : asset('storage/fotos/' . $piloto->foto_url)}}" class="img-thumbnail"/> </td>
                    <td>{{ $piloto->name }}</td>
                    <td>{{ $piloto->email }}</td>
                    <td>{{ $piloto->tSocioToString() }}</td>
                    <td>{{ $piloto->nrLicencaToString() }}</td>
                    <td>{{ $piloto->direcaoToString() }}</td>
                    <td>
                        @can('delete', $piloto)
                            <a class="btn btn-xs btn-primary" href="{{route('aeronaves.pilotoDestroy', $piloto)}}">Editar</a>
                        @endcan
                    </td>
                </tr>
                @endif
            @endforeach
        </table>

        {{$pilotos->links()}}

    @else

        <h2>Não foram encontrados pilotos</h2>

    @endif


</div>
@endsection

