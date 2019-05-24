@extends('layouts.app')

@section('title', 'Pilotos da aeronave')

@section('content')

<div class="container">
    @can('authorize', $aeronave)
    <div>
        <a class="btn btn-primary" href="{{route( 'aeronaves.pilotosNaoAutorizadosIndex', $aeronave)}}">Autorizar Piloto(s)</a>
    </div>
    @endcan
    
    @include('aeronaves.shared.list-pilotos')


</div>
@endsection

