@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Lista de Ingredientes
            <a href="{{ route('ingredientes.create') }}" class="ui black button" style="float: right;">Crear Ingrediente</a>
        </h2>
        <!-- Mostrar la tabla con los ingredientes -->
        <table class="ui celled table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Botones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ingredientes as $ingrediente)
                <tr>
                    <td>{{ $ingrediente->id }}</td>
                    <td>{{ $ingrediente->name }}</td>
                    <td>
                        <!-- Enlaces a editar y eliminar -->
                        <div class="ui buttons">
                            <a href="{{ route('ingredientes.edit', $ingrediente->id) }}" class="ui green button">Editar</a>
                            <form action="{{ route('ingredientes.destroy', $ingrediente->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="ui red button" type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar este ingrediente?')">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
