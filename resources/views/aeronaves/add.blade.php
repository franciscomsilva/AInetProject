@extends('layouts.app')

@section('title', 'Adicionar Aeronave')

@section('content')

<!-- só os socios da direção é que pode acrescentar, alterar ou remover aeronaves! -->


<form action="{{route('aeronaves.create')}}" method="post" class="form-group">
    

    @include('aeronaves.partials.add-edit')

    <div class="form-group"> 
        <button type="submit" class="btn btn-success" name="ok">Adicionar</button>
        <a type="submit" class="btn btn-default" href="{{route('aeronaves.index')}}">Cancelar</a>
    </div>
</form>
@endsection
