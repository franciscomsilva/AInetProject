@extends('layouts.app')

@section('title','Movimentos')

@section('content')
<div class="container">
    @if (count($errors) > 0)
        @include('shared.errors')
    @endif

        <div>
        <a class="btn btn-primary" href="{{route('movimentos.create')}}">Adicionar</a>
    </div>

        @if (count($movimentos))
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Aeronave</th>
                <th>Data Voo</th>
                <!--th>Hora Aterragem</th>
                <th>Hora Descolagem</th-->
                <th>Tempo Voo</th>
                <th>Natureza</th>
                <th>Piloto Nome</th>
                <th>Aeródromo Partida</th>
                <th>Aeródromo Chegada</th>
                <!--th>Nº Aterragens</th>
                <th>Nº Descolagens</th>
                <th>Nº Diário</th>
                <th>Nº Serviço</th>
                <th>Conta-Horas Inicial</th>
                <th>Conta-Horas Final</th>
                <th>Nº Pessoas</th-->
                <th>Tipo Instrução</th>
                <th>Instrutor</th>
                <th>Confirmado</th>
                <th> </th>
            </tr>
            </thead>
            <tbody>
            @foreach($movimentos as $movimento)
                <tr>
                    <td>{{$movimento->id}}</td>
                    <td> {{$movimento->aeronave}}</td>
                    <td>{{$movimento->data}}</td>
                    <!--td>date('H:i', strtotime($movimento->hora_aterragem))</td-->
                    <!--td>date('H:i', strtotime($movimento->hora_descolagem))</td-->
                    <td>{{$movimento->tempo_voo}} min</td>
                    <td>{{$movimento->naturezaMovimentoToString()}}</td>
                    <td>{{$movimento->piloto->nome_informal}}</td>
                    <td>{{$movimento->aerodromo_partida}}</td>
                    <td>{{$movimento->aerodromo_chegada}}</td>
                    <!--td>$movimento->num_aterragens</td-->
                    <!--td>$movimento->num_descolagens</td-->
                    <!--td>$movimento->num_diario</td-->
                    <!--td>$movimento->num_servico</td-->
                    <!--td>$movimento->conta_horas_inicio</td-->
                    <!--td>$movimento->conta_horas_fim</td-->
                    <!--td>$movimento->num_pessoas</td-->
                    <td>{{$movimento->tipoInstrucaoToString()}}</td>
                    <td></td>
                    <td>
                        <div class="input-group mb-3">
                            <div class="input-group">
                                <input type="checkbox" disabled {{$movimento->confirmado()}}>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a class="btn btn-xs btn-primary" href="{{route('movimentos.show', $movimento)}}"><img src="/imagens/eye.png" class="" alt="mostrar"></a>
                        @can('update', $movimento)
                            <a class="btn btn-xs btn-primary" href="{{route('movimentos.edit', $movimento)}}"><img src="/imagens/pencil.png" class="" alt="editar"></a>
                        @endcan
                        @can('delete', $movimento)
                            <form action="{{route('movimentos.destroy', $movimento)}}" method="POST" role="form" class="inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-xs btn-danger"><img src="/imagens/delete.png" class="" alt="apagar"></button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </table>

        {{ $movimentos->links() }}


    @else

        <h2>No ... found</h2>

    @endif


</div>
@endsection

