@extends('layouts.app')

@section('title', 'Lista de Pendentes')

@section('content')

    @if (count($errors) > 0)
        @include('shared.errors')
    @endif
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Tipo</th>
            <th>Número</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            @foreach($pendentes as $pendente)
            <tr>
                <td>{{isset($pendente['num_socio']) ? ($pendente['licenca_confirmada'] == 0 ? 'Sócio com licença não confirmada' : 'Sócio com certificado não confirmado') : (is_null($pendente['tipo_conflito']) ? 'Movimento não confirmado': 'Movimento com conflito')}}</td>
                <td>{{isset($pendente['num_socio']) ? $pendente['num_socio'] : $pendente['num_servico']}}</td>
                <td><a class="btn btn-xs btn-success" href="{{isset($pendente['num_socio'])? route('user.edit',$pendente['id']) : route('movimentos.edit',$pendente['id'])}}">{{isset($pendente['num_socio']) ? 'Editar Sócio' : 'Editar Movimento'}}</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <input type="button" value="Refresh" onClick="window.location.reload()">

@endsection
