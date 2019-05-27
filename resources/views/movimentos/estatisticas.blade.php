@extends('layouts.app')

@section('title', 'Estatísticas de Voo')

@section('content')

    @if (count($errors) > 0)
        @include('shared.errors')
    @endif

    @if(count($users) && count($aeronaves))
        <div class="form-group">

            <label for="inputPiloto">Piloto</label>
            <select id='select-piloto' name="piloto">
                @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->nome_informal}}({{$user->num_socio}})</option>
                @endforeach
            </select>

            <label for="inputAeronave">Aeronave</label>
            <select id='select-aeronave' name="aeronave">
                @foreach ($aeronaves as $aeronave)
                    <option value="{{$aeronave->matricula}}">{{$aeronave->matricula}}</option>
                @endforeach
            </select>
        </div>
    @endif

@endsection
