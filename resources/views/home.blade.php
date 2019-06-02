@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible" rolee="alert">
            {{ session('status') }} 
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            Bem vindo ao <strong>Flight-Club</strong> {{ Auth::User()->nome_informal }}
        </div>
    @endif
    <br><br><br>
    <div class="start-page">
        <div class="title m-b-md">
            Flight-Club
            <img src="https://i.imgur.com/PxSC8kg.png"/>
        </div>

        <div class="links">
            @auth()
                <a href="{{ route('user.index') }}">Sócios</a>
                <a href="{{ route('aeronaves.index') }}">Aeronaves</a>
                <a href="{{ route('movimentos.index') }}">Movimentos</a>
                <a href="{{ route('movimentos.estatisticas') }}">Estatísticas</a>
                @can('viewPendentes',Auth::user())
                    <a href="{{ route('movimentos.pendentes') }}"> Pendentes </a>
                @endcan
            @endauth
        </div>
    </div>
</div>
@endsection
