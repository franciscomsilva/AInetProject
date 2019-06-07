@extends('layouts.app')

@section('title','Aeródromos')

@section('content')
    <!-- secção dos breadcrumbs -->

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Flight-Club</a></li>
            <li class="breadcrumb-item active">Aeródromos</li>
        </ol>
    </nav>

    @if(count($aerodromos) > 0)
        <table class="table table-striped" style="text-alighn: center;">
            <thead>
            <tr>
                <th>Code</th>
                <th>Nome</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($aerodromos as $aerodromo)
                <tr>
                    <td>{{ $aerodromo->code }}</td>
                    <td>{{ $aerodromo->nome }}</td>
                    <td><a class="btn btn-xs btn-primary" href="{{route('aerodromo.edit', $aerodromo)}}">Editar</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $aerodromos->links() }}
    @else
        <h2>Nenhum aeródromo encontrado!</h2>
    @endif

@endsection
