@extends('layouts.app')

@section('title', 'Pilotos')

@section('content')

@php 
$autorizar = 1;
@endphp

<div class="container">
@include('aeronaves.shared.list-pilotos') 
</div>
@endsection

