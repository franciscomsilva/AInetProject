@extends('layouts.app')

@section('title', 'Editar Movimento')

@section('content')
<<<<<<< HEAD

=======
>>>>>>> f3b5a81377898d6127de61e4e5945388d250ab8d
    <form action="{{route('movimentos.update', $movimento)}}" method="post" class="form-group">
        {{method_field('PUT')}}
        @include('movimentos.partials.add-edit')
        <div class="form-group">
            <button type="submit" class="btn btn-success" name="ok">Guardar</button>
            <a type="submit" class="btn btn-default" name="cancel" href="{{route('movimentos.index')}}">Cancelar</a>
        </div>
    </form>
@endsection
