@extends('layouts.app')

@section('title', 'Tabela de Preços - ' . $aeronave->marca . ' ' . $aeronave->modelo)

@section('content')
<div class="container">
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Flight-Club</a></li>
            <li class="breadcrumb-item"><a href="{{ route('aeronaves.index') }}">Aeronaves</a></li>
            <li class="breadcrumb-item active">{{ $aeronave->matricula }} </li>
            <li class="breadcrumb-item active">Preços</li>
        </ol>
    </nav>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Unidade Conta-Horas</th>
                    <th>Minutos</th>
                    <th>Preço</th>
                </tr>
            </thead>
            <tbody>
                @foreach($precos_tempos as $preco_tempo)
                    <tr>
                        <td>{!! $preco_tempo->unidade_conta_horas !!}</td>
                        <td>{!! $preco_tempo->minutos !!}</td>
                        <td>{!! $preco_tempo->preco !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <td>
            @can('update', $aeronave)
            <a class="btn  btn-primary" href="{{route('aeronaves.edit', $aeronave)}}">Editar</a>
            @endcan
        </td>
    </div>

</div>
@endsection

