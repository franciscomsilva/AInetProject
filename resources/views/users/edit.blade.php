@extends('layouts.app')

@section('title', 'Edit user')

@section('content')

    @if (count($errors) > 0)

    @endif

    <form action="{{route('user.store')}}" method="post" class="form-group">
        @include('users.partials.add-edit')
        <div class="form-group">
            <button type="submit" class="btn btn-success" name="ok">Add</button>
            <a type="submit" class="btn btn-default" href="{{route('user.home')}}">Cancel</a>
        </div>
    </form>
@endsection
