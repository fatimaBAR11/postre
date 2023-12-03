<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Restaurant') }}</title>
    <link href="{{ asset('css/semantic.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/icon.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/icon.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <div class="ui fixed inverted menu" style="background-color: rgba(19, 18, 18, 0.747);">
            <div class="ui container">
                <a href="{{ url('/') }}" class="header item">
                    <img src="{{ asset('images/logo.png') }}" class="ui mini image" style="margin-right: 10px;">
                </a>
                <div class="right menu">
                    @guest
                    @else
                        <a href="{{ route('usuarios.index') }}" class="item">Usuarios</a>
                        <a href="{{ route('ingredientes.index') }}" class="item">Ingredientes</a>
                        <a href="{{ route('postres.index') }}" class="item">Postres </a>
                        <div class="ui simple dropdown item">                       
                            <span class="text">{{ Auth::user()->name }}</span>
                            <i class="dropdown icon"></i>
                            <div class="menu">
                                <a class="item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Cerrar Sesión') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="ui form">
                                    @csrf
                                </form>
                            </div>                        
                        </div>
                    @endguest
                </div>
            </div>
        </div>
        <div class="ui main container" style="margin-top: 80px;">
            @yield('content')
        </div>
    </div>
</body>
</html>
