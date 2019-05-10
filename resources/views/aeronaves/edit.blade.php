@extends('layouts.app')

@section('title', 'Editar Aeronave')

@section('content')
 
@if (count($errors) > 0)
    @include('shared.errors')
@endif
<!-- só os socios da direção é que pode acrescentar, alterar ou remover aeronaves! -->

<form action="{{route('aeronaves.update', $aeronave)}}" method="post" class="form-group">
    {{method_field('PUT')}}

    <div class="form-group"><!-- Matricula -->
        <label for="inputMatricula">Matricula</label>
        <input type="text" class="form-control" name="matricula" id="inputMatricula" value="{{old('matricula')}}"/>
    </div>
    <div class="form-group"> <!-- Marca -->
        <label for="inputMarca">Marca</label>
        <input type="text" class="form-control" name="marca" id="inputmarca" value="{{old('marca')}}"/>
    </div>
    <div class="form-group"> <!-- Modelo -->
        <label for="inputModelo">Modelo</label>
        <input type="text" class="form-control" name="modelo" id="inputModelo" value="{{old('modelo')}}"/>
    </div>

    <div class="form-group"> <!-- numero Lugares --> 
        <label for="inputNumLugares">Numero de Lugares</label>
        <input type="text" class="form-control" name="num_lugares" id="inputNum_lugares" value="{{old('num_lugares')}}"/>
    </div>

    @include('aeronaves.partials.add-edit')
    <div class="form-group">
        <button type="submit" class="btn btn-success" name="ok">Guardar</button>
        <a type="submit" class="btn btn-default" name="cancel" href="{{route('aeronaves.index')}}">Cancelar</a>
    </div>
</form>
@endsection
