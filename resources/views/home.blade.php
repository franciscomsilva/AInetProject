@extends('layouts.app')

@section('content')
<div class="container">
    <!--div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }} 
                            </div>
                        @endif
                    </div>
            </div>
        </div>
    </div-->
    @if (session('status'))
        <div class="alert alert-success alert-dismissible">
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
