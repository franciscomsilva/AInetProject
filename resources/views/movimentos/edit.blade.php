@extends('layouts.app')

@section('title', 'Editar Movimento')

@section('content')

    <form action="{{route('movimentos.update', $movimento)}}" method="post" class="form-group">
        {{method_field('PUT')}}
        @include('movimentos.partials.add-edit')
        <div class="form-group">
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a type="submit" class="btn btn-default" name="cancel" href="{{route('movimentos.index')}}">Cancel</a>
        </div>
    </form>
@endsection
