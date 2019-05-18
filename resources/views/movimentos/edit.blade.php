@extends('layouts.app')

@section('title', 'Editar Movimento')

@section('content')

    @if (count($errors) > 0)
        @include('shared.errors')
    @endif


@endsection
