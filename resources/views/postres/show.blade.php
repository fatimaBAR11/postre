@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detalles del postre #{{ $postre->id }}</h2>
        <div class="ui segment">
            <h3>Información del postre:</h3>
            <p>Nombre: {{ $postre->nombre }}</p>
            <p>Preparacion: {{ $postre->preparacion }}</p>
        </div>

        <h3>Agregar Ingredientes:</h3>
        <div class="ui segment">
            <table class="ui celled table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Boton</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ingredientes as $ingrediente)
                    <tr>
                        <td>{{ $ingrediente->id }}</td>
                        <td>{{ $ingrediente->name }}</td>
                        <td>
                            <form action="{{ route('postres.agregarIngrediente', [$postre->id, $ingrediente->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class="ui green button" type="submit">Agregar</button>
                            </form>                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h3>Ingredientes del postre:</h3>
        <div class="ui segment">
            <table class="ui celled table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Boton</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($postre->postreDetalles as $detalle)
                        <tr>
                            <td>{{ $detalle->ingrediente->id }}</td>
                            <td>{{ $detalle->ingrediente->name }}</td>
                            <td>
                                <form action="{{ route('postres.borrar', ['postre_id' => $postre->id, 'ingrediente_id' => $detalle->ingrediente->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="ui red button" type="submit">Eliminar</button>
                                </form>  
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
