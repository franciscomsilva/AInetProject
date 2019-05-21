@extends('layouts.app')

@section('title', 'Adicionar Sócio')

@section('content')

@if (count($errors) > 0)
    @include('shared.errors')
@endif

<form action="{{route('user.store')}}" method="post" class="form-group" enctype="multipart/form-data">
    @include('users.partials.add-edit')
    <div class="form-group text-right">
        <button type="submit" class="btn btn-success" name="ok">Adicionar</button>
        <a type="submit" class="btn btn-default" href="{{route('user.index')}}">Cancelar</a>
    </div>
</form>
@endsection
