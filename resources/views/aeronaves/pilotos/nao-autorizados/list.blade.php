@extends('layouts.app')

@section('title', 'Pilotos')

@section('content')

@php 
$adicionarRemover = 'aeronaves.autorizarPiloto';
$textoButao = 'Não Autorizar';
@endphp

<div class="container">
@include('aeronaves.shared.list-pilotos') 
</div>
@endsection

