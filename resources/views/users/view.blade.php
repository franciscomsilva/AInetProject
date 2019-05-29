@extends('layouts.app')

@section('title', 'Sócio')

@section('content')


    @if (count($errors) > 0)
        @include('shared.errors')
    @endif


    <form action="{{route('user.edit',$user)}}" method="get" class="form-group" enctype="multipart/form-data">
        @include('users.partials.view')
        <div class="form-group">
            <button type="submit" class="btn btn-success" name="ok">Editar</button>
            <a type="submit" class="btn btn-default" href="{{route('user.index')}}">Cancel</a>
        </div>
    </form>
@endsection
