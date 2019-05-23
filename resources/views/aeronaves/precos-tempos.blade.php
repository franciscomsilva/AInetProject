@extends('layouts.app')

@section('title', 'Tabela de Preços')

@section('content')
<div class="container">


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
    </div>

</div>
@endsection

