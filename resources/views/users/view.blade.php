@extends('layouts.app')

@section('title', 'Sócio')

@section('content')
<!-- secção dos breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Flight-Club</a></li>
        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Sócios</a></li>
        <li class="breadcrumb-item active">{{ $user->nome_informal }}</li>
    </ol>
</nav>

    @if (count($errors) > 0)
        @include('shared.errors')
    @endif

    <br>

    <form action="{{route('user.edit',$user)}}" method="get" class="form-group" enctype="multipart/form-data">
        @include('users.partials.view')
        <div class="form-group">
            <button type="submit" class="btn btn-success" name="ok">Editar</button>
            <a type="submit" class="btn btn-default" href="{{route('user.index')}}">Cancel</a>
        </div>
    </form>
@endsection
