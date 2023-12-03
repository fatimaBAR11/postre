@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="ui header">Editar Ingrediente</h2>
        <!-- Formulario para editar una ingrediente existente -->
        <form class="ui form" action="{{ route('ingredientes.update', $ingrediente->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="ui grid">
                <div class="eight wide column">
                    <div class="field">
                        <label>Nombre:</label>
                        <input type="text" name="name" value="{{ $ingrediente->name }}" required>
                    </div>
                </div>
            </div><br>
            <button class="ui black button" type="submit">Guardar</button>
        </form>
    </div>
@endsection
