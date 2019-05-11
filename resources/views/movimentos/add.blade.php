@extends('layouts.app')

@section('title','Adicionar Movimentos')

@section('content')

    @if (count($errors) > 0)
        @include('shared.errors')
    @endif

    <form action="{{route('movimentos.store')}}" method="post" class="form-group">
        @include('movimentos.partials.add-edit')

    </form>
@endsection
