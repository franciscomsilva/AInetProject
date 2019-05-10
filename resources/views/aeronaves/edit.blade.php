@extends('layouts.app')

@section('title', 'Editar Aeronave')

@section('content')
 
@if (count($errors) > 0)
    @include('shared.errors')
@endif
<!-- só os socios da direção é que pode acrescentar, alterar ou remover aeronaves! -->

<form action="{{route('aeronaves.update', $aeronave)}}" method="post" class="form-group">
    {{method_field('PUT')}}
    @include('aeronaves.partials.add-edit')
    <div class="form-group">
        <button type="submit" class="btn btn-success" name="ok">Guardar</button>
        <a type="submit" class="btn btn-default" name="cancel" href="{{route('aeronaves.index')}}">Cancelar</a>
    </div>
</form>
@endsection
