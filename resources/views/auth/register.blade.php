@extends('layouts.app')

@section('content')
    <div class="ui middle aligned center aligned grid" style="background-color: rgba(233, 226, 226, 0.938); height: 100vh;">

            <div class="column" style="max-width: 450px; background-color: rgb(233, 130, 130);">
                <h2 class="ui teal image header">
                    <img class="ui circular image" src="{{ asset('images/logo.png') }}" alt="Logo" >
                </h2>
                <form class="ui large form" method="POST" action="{{ route('register') }}" >
                    @csrf
                    <div class="ui stacked segment" style="background-color: rgba(233, 226, 226, 0.938);">
                        <div class="field">
                            <div class="ui input">
                                <input type="text" name="name" placeholder="Nombre" required autofocus>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui input">
                                <input type="email" name="email" placeholder="E-Mail" required autofocus>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui input">
                                <input type="password" name="password" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui input">
                                <input type="password" name="password_confirmation" placeholder="Confirmar Password" required>
                            </div>
                        </div>
                        @if ($errors->any())
                            <div class="ui negative message">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <button type="submit" style="background-color: black;" class="ui fluid large teal submit button">Registrar</button>
                    </div>
                </form>
                <div class="ui message" style="background-color: rgba(233, 226, 226, 0.938);">
                    ¿Tienes cuenta? <a href="{{ route('login') }}">Login</a>
                </div>
            </div>

    </div>
@endsection
