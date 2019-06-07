@extends('layouts.app')

@section('title', 'Editar Aeródromo')

@section('content')

<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Flight-Club</a></li>
            <li class="breadcrumb-item"><a href="{{ route('aerodromo.index') }}">Editar Aeródromo</a></li>
        </ol>
</nav>

<form action="{{route('aerodromo.update', $aerodromo)}}" method="post" class="form-group">
    {{method_field('PUT')}}
    {{csrf_field()}}

    <div class="form-group">
        <label for="inputCode">Code</label>
        <input disabled
                type="text" class="form-control"
                name="code" id="inputCode"
                placeholder="Code" value="{{old('code', $aerodromo->code)}}" />
    </div>

    <div class="form-group">
        <label for="inputNome">Nome</label>
        <input
                type="text" class="form-control"
                name="nome" id="inputNome"
                placeholder="Nome" value="{{old('nome', $aerodromo->nome)}}" />
    </div>




    <div class="form-group">
        <button type="submit" class="btn btn-success" name="ok">Guardar</button>
        <a type="submit" class="btn btn-default" name="cancel" href="{{route('aerodromo.index')}}">Cancelar</a>
    </div>
</form>
@endsection


