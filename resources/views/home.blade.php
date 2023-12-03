@extends('layouts.app')

@section('content')
    <div class="ui container" style="margin-top: 60px;">
        <!-- Restaurant Information -->
        <div class="ui segment">
            <h2 class="ui center aligned header">¡Bienvenido a nuestra página de postres!</h2>
            <div class="ui divider"></div>
            <div class="ui center aligned grid">
                <img src="{{ asset('images/logo.png') }}" alt="Imagen de Postre" style="max-width: 400px; height: auto;">
            </div>
        </div>
    </div>
@endsection
