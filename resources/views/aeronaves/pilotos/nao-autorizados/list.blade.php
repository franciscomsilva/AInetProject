@extends('layouts.app')

@section('title', 'Pilotos')

@section('content')

@php 
$autorizar = true;
$textoButao = 'Autorizar piloto';
@endphp

<div class="container">
@include('aeronaves.shared.list-pilotos') 
</div>
@endsection

