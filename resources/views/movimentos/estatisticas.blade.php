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
                g

                <option {{$user->tipo_socio == "P" ? 'selected' : ''}} value="P">Piloto</option>
                <option {{$user->tipo_socio == "NP" ? 'selected' : ''}} value="NP">Não-Piloto</option>
                <option {{$user->tipo_socio == "A" ? 'selected' : ''}} value="A">Aeromodelista</option>
            </select>

            <label for="inputAeronave">Aeronave</label>
            <select id='select-aeronave' name="aeronave">
                <option {{$user->tipo_socio == "P" ? 'selected' : ''}} value="P">Piloto</option>
                <option {{$user->tipo_socio == "NP" ? 'selected' : ''}} value="NP">Não-Piloto</option>
                <option {{$user->tipo_socio == "A" ? 'selected' : ''}} value="A">Aeromodelista</option>
            </select>
        </div>
    @endif

@endsection
