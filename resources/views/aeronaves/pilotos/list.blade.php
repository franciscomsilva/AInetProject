@extends('layouts.app')

@section('title', 'Pilotos da aeronave')

@section('content')

<div class="container">
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Flight-Club</a></li>
            <li class="breadcrumb-item"><a href="{{ route('aeronaves.index') }}">Aeronaves</a></li>
            <li class="breadcrumb-item active">{{ $aeronave->matricula }} </li>
            <li class="breadcrumb-item active">Pilotos</li>
        </ol>
    </nav>

    @can('authorize', $aeronave)
    <div>
        <a class="btn btn-primary" href="{{route( 'aeronaves.pilotosNaoAutorizadosIndex', $aeronave)}}">Autorizar Piloto(s)</a>
    </div>
    @endcan
    
    @include('aeronaves.shared.list-pilotos')


</div>
@endsection

