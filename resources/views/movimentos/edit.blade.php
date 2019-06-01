@extends('layouts.app')

@section('title', 'Editar Movimento')

@section('content')
    <!-- Secção das breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Flight-Club</a></li>
            <li class="breadcrumb-item"><a href="{{ route('movimentos.index') }}">Movimentos</a></li>
            <li class="breadcrumb-item"><a href="{{ route('movimentos.show', $movimento) }}">{{ $movimento->id }}</a></li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
    </nav>




    <form action="{{route('movimentos.update', $movimento)}}" method="post" class="form-group">
        {{method_field('PUT')}}
        @include('movimentos.partials.add-edit')
        <div class="form-group">
            <button type="submit" class="btn btn-success" name="ok">Guardar</button>
            <a type="submit" class="btn btn-default" name="cancel" href="{{route('movimentos.index')}}">Cancelar</a>
        </div>
    </form>
@endsection
