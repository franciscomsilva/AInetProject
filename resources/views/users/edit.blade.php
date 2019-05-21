@extends('layouts.app')

@section('title', 'Editar Sócio')

@section('content')

    @if (count($errors) > 0)
        @include('shared.errors')
    @endif
    
<div>
    <form action="{{route('user.update',$user)}}" method="post" class="form-group" enctype="multipart/form-data">
        {{method_field('PUT')}}
        @include('users.partials.add-edit')
        <div class="form-group">
            <button type="submit" class="btn btn-success" name="ok">Guardar</button>
            <a type="submit" class="btn btn-danger" href="{{route('user.destroy',$user)}}">Apagar</a>
            <a type="submit" class="btn btn-default" href="{{route('user.index')}}">Cancelar</a>
        </div>
    </form>
    @can('enviarEmail',$user)
        <form action="{{route('user.email',$user)}}" method="post" class="form-group" >
            @csrf
            <div class="form-group">
                <button type="submit" class="btn btn-warning" name="reenviar">Reenviar Email</button>
            </div>
        </form>
    @endcan
</div>
@endsection
