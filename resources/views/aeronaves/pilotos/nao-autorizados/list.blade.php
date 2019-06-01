@extends('layouts.app')

@section('title', 'Pilotos')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Flight-Club</a></li>
            <li class="breadcrumb-item"><a href="{{ route('aeronaves.index') }}">Aeronaves</a></li>
            <li class="breadcrumb-item active">{{ $aeronave->matricula }} </li>
            <li class="breadcrumb-item"><a href="{{ route('aeronaves.pilotosIndex', Route::current()->parameter('aeronave')) }}">Pilotos</a></li>
            <li class="breadcrumb-item active">Não Autorizados</li>
        </ol>
    </nav>

@include('aeronaves.shared.list-pilotos') 

@endsection

