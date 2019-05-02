@extends('layouts.app')


@section('content')
<div class="container">
    <table>

    @foreach ($users as $user)
        <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->sexo }}</td>
        </tr>
    @endforeach
    </table>

    {{ $users->links() }}

</div>
@endsection

