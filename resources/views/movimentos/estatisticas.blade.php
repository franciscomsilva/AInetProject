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

            <div id="div_movimentos_piloto"></div>
            <br>
            <div id="div_movimentos_aeronaves"></div>

            {!!$lava->render('LineChart', 'Movimentos do Piloto', 'div_movimentos_piloto')!!}
            {!!$lava->render('LineChart', 'Movimentos da Aeronaves', 'div_movimentos_aeronaves')!!}


        @endisset
    @endif

@endsection
