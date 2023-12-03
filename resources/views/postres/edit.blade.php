@extends('layouts.app')

@section('content')
    <div class="ui container">
        <h2 class="ui header">Editar Postre</h2>
        <!-- Formulario para editar un postre -->
        <form class="ui form" action="{{ route('postres.update', $postre->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="two fields">
                <div class="field">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre" value="{{ $postre->nombre }}" required>
                </div>
                <div class="field">
                    <label for="imagen">Imagen:</label>
                    <input type="file" id="imagen" name="imagen">
                </div>
            </div>
            <div class="field">
                <label for="preparacion">Preparación:</label>
                <textarea id="preparacion" name="preparacion" placeholder="Descripción de la preparación del postre">{{ $postre->preparacion }}</textarea>
            </div><br>
            <div class="ui buttons">                
                <button class="ui black button" type="submit">Actualizar</button>                
            </div>
        </form>
    </div>
@endsection
