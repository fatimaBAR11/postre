@extends('layouts.app')

@section('content')
    <div class="ui container">
        <h2 class="ui header">Crear Postre</h2>
        <!-- Formulario para crear una nuevo postre -->
        <form class="ui form" action="{{ route('postres.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="two fields">
                <div class="field">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
                </div>
                <div class="field">
                    <label for="imagen">Imagen:</label>
                    <input type="file" id="imagen" name="imagen">
                </div>
            </div>
            <div class="field">
                <label for="preparacion">Preparación:</label>
                <textarea id="preparacion" name="preparacion" placeholder="Descripción de la preparación del postre"></textarea>
            </div><br>
            <button class="ui black button" type="submit">Enviar</button>
        </form>
    </div>
@endsection
