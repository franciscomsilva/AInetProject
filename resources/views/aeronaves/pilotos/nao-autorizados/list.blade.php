@extends('layouts.app')

@section('title', 'Pilotos')

@section('content')

@php ($autorizar = 1)

<div class="container">
@include('aeronaves.shared.list-pilotos') 


</div>
@endsection

