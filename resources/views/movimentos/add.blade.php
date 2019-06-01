@extends('layouts.app')
@section('title', 'Adicionar Movimento')
@section('content')

    <!-- Secção das breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Flight-Club</a></li>
            <li class="breadcrumb-item"><a href="{{ route('movimentos.index') }}">Movimentos</a></li>
            <li class="breadcrumb-item active">Criar</li>
        </ol>
    </nav>



    <form action="{{route('movimentos.store')}}" method="post" class="form-group">
        @include('movimentos.partials.add-edit')
        <div class="form-group">
            <button type="submit" class="btn btn-success" name="ok">Adicionar</button>
            <a type="submit" class="btn btn-default" href="{{route('movimentos.index')}}">Cancelar</a>
        </div>
    </form>

@endsection
