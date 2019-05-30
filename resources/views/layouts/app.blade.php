<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Flight-Club') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth()
                        <li>
                            <a class="nav-item ml-3" href="{{ route('user.index') }}"> Sócios </a>
                        </li>
                        <li>
                            <a class="nav-item ml-3" href="{{ route('aeronaves.index') }}"> Aeronaves </a>
                        </li>
                        <li>
                            <a class="nav-item ml-3" href="{{ route('movimentos.index') }}"> Movimentos </a>
                        </li>
                         <li>
                                <a class="nav-item ml-3" href="{{ route('movimentos.estatisticas') }}"> Estatísticas </a>
                         </li>
                         @can('viewPendentes',Auth::user())
                                <li>
                                    <a class="nav-item ml-3" href="{{ route('movimentos.pendentes') }}"> Pendentes </a>
                                </li>
                         @endcan
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.home') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('home-form').submit();">
                                        {{ __('Home') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('user.show',Auth::user()) }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('profile-form').submit();">
                                        {{ __('Perfil') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('user.password') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('password-form').submit();">
                                        {{ __('Alterar Password') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <form id="profile-form" action="{{ route('user.show',Auth::user()) }}" method="GET" style="display: none;">
                                        @csrf
                                    </form>
                                    <form id="password-form" action="{{ route('user.password') }}" method="GET" style="display: none;">
                                        @csrf
                                    </form>
                                    <form id="home-form" action="{{ route('user.home') }}" method="GET" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @hasSection('title')
                    <div class="jumbotron">
                        <h1>@yield('title')</h1>
                    </div>
                @endif
                @if (session('success'))
                    @include('shared.success')
                @endif
                @if (session('errors'))
                    @include('shared.errors')
                @endif
            @yield('content')
         </div>
        </main>
    </div>
</body>
</html>
