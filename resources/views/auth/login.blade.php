@extends('layouts.app')

@section('content')
    <div class="ui middle aligned center aligned grid" style="background-color: rgba(233, 226, 226, 0.938); height: 100vh;">

            <div class="column" style="max-width: 450px; background-color: rgb(233, 130, 130);">
                <h2 class="ui teal image header">
                    <img class="ui circular image" src="{{ asset('images/logo.png') }}" alt="Logo" >
                </h2>
                <form class="ui large form" method="POST" action="{{ route('login') }}" >
                    @csrf
                    <div class="ui stacked segment" style="background-color: rgba(233, 226, 226, 0.938);">
                        <div class="field">
                            <div class="ui left icon input">
                                <input type="email" name="email" placeholder="E-Mail" required autofocus>
                            </div>
                            @error('email')
                                <p style="color: rgba(233, 226, 226, 0.938);">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="ui left icon input">
                                <input type="password" name="password" placeholder="Password" required>
                            </div>
                            @error('password')
                                <p style="color: rgba(233, 226, 226, 0.938);">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" style="background-color: black;" class="ui fluid large teal submit button">Login</button>
                    </div>
                </form>
                <div class="ui message" style="background-color: rgba(233, 226, 226, 0.938);">
                    Tienes cuenta? <a href="{{ route('register') }}">Regístrate</a>
                </div>
            </div>
    </div>
@endsection
