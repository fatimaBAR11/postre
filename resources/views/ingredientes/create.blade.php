@extends('layouts.app')

@section('content')
    <div class="ui container">
        <h2 class="ui header">Crear Ingrediente</h2>
        <!-- Formulario para crear una nueva ingrediente -->
        <form class="ui form" action="{{ route('ingredientes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="two fields">
                <div class="field">
                    <label for="name">Nombre:</label>
                    <input type="text" id="name" name="name" placeholder="Nombre" required>
                </div>
                <div class="field">
                    <label for="imagen">Imagen:</label>
                    <input type="file" id="imagen" name="imagen">
                </div>
            </div><br>
            <button class="ui black button" type="submit">Enviar</button>
        </form>
    </div>
@endsection
