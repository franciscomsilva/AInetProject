@extends('layouts.app')
@section('title', 'Adicionar Movimento')
@section('content')
    <form action="{{route('movimentos.store')}}" method="post" class="form-group">
        @include('movimentos.partials.add-edit')
        <div class="form-group">
            <button type="submit" class="btn btn-success" name="ok">Adicionar</button>
            <a type="submit" class="btn btn-default" href="{{route('movimentos.index')}}">Cancelar</a>
        </div>
    </form>

@endsection
