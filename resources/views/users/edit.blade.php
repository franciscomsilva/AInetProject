@extends('layouts.app')

@section('title', 'Editar Sócio')

@section('content')
<!-- secção dos breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Flight-Club</a></li>
        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Sócios</a></li>
        <li class="breadcrumb-item"><a href="{{route('user.show', $user)}}">{{ $user->nome_informal }}</a> </li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
</nav>

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
