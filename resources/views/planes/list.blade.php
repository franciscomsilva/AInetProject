@extends('master')

@section('title', 'List planes')

@section('content')
<div><a class="btn btn-primary" href="{{ route('users.create') }}">Add user</a></div>
@if(count($planes))
    <table class="table table-striped">
    <thead>
        <tr>
            <th>Matrícula</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Nº Lugares</th>
            <th>Conta Horas</th>
            <th>Preço por hora</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($planes as $plane) 
        <tr>
            <td> {{ $planes->licence_plate }} </td>
            <td> {{ $planes->brand }} </td>
            <td> {{ $planes->model }} </td>
            <td> {{ $planes->seates }} </td>
            <td> {{ $planes->count_hours }} </td>
            <td> {{ $planes->price_hour }} </td>
        </tr>
    @endforeach
    </table>

@else
   <h2>No planes found</h2>

@endif