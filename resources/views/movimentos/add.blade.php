@extends('layouts.app')
@section('title', 'Adicionar Movimento')
@section('content')

    @if (count($errors) > 0)
        @include('shared.errors')
    @endif

    <form action="{{route('movimentos.store')}}" method="post" class="form-group">
        @include('movimentos.partials.add-edit')
        <div class="form-group">
            <button type="submit" class="btn btn-success" name="ok">Add</button>
            <a type="submit" class="btn btn-default" href="{{route('movimentos.index')}}">Cancel</a>
        </div>
    </form>

@endsection
