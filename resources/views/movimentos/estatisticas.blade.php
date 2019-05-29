@extends('layouts.app')

@section('title', 'Estatísticas de Voo')

@section('content')

    @if (count($errors) > 0)
        @include('shared.errors')
    @endif

    @if(count($users) && count($aeronaves))
        <div class="form-group">
            <form action="{{route('movimentos.getEstatisticas')}}" method="post" class="form-group">
                {{csrf_field()}}
                <label for="inputPiloto">Piloto</label>
                <select id='select-piloto' name="piloto_id">
                    <option disabled selected value>--Piloto--</option>
                    @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->nome_informal}}({{$user->num_socio}})</option>
                    @endforeach
                </select>

                <label for="inputAeronave">Aeronave</label>
                <select id='select-aeronave' name="aeronave_matricula">
                    <option disabled selected value>--Aeronave--</option>
                    @foreach ($aeronaves as $aeronave)
                        <option value="{{$aeronave->matricula}}">{{$aeronave->matricula}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-success" name="ok">Mostrar</button>
            </form>
        </div>
        @isset($lava)
            <h1>Movimentos do Piloto</h1>
            <br>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Ano</th>
                    <th>Nº de Horas</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($movimentosTempoPiloto->toArray() as $movimento)
                    <tr>
                        <td>{{$movimento->ano}}</td>
                        <td>{{$movimento->tempo_total}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <h2>Gráfico</h2>
            <br>
            <div id="div_movimentos_piloto"></div>
            <br>


            <h1>Movimentos da Aeronaves</h1>
            <br>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Mês</th>
                    <th>Nº de Horas</th>
                </tr>
                </thead>
                <tbody>
                @foreach($movimentosTempoAeronave->toArray() as $movimento)
                    <tr>
                        <td>{{$movimento->mes}}</td>
                        <td>{{$movimento->tempo_total}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br>
            <h2>Gráfico</h2>
            <br>
            <div id="div_movimentos_aeronave"></div>

            {!!$lava->render('LineChart', 'Movimentos do Piloto', 'div_movimentos_piloto')!!}
            {!!$lava->render('LineChart', 'Movimentos da Aeronaves', 'div_movimentos_aeronave')!!}


        @endisset
    @endif

@endsection
