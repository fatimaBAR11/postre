@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Lista de postres
            <a href="{{ route('postres.create') }}" class="ui green button" style="float: right;">Crear Postre</a>
            <a href="{{ route('postres.pdf.generate') }}" class="ui blue button" style="float: right; margin-right: 10px;" target="_blank">PDF</a>
        </h2>
        <!-- Input de búsqueda -->
        <div class="ui input" style="margin-bottom: 10px;"><br><br>
            <input type="text" id="searchInput" placeholder="Buscar postre...">
        </div>
        <!-- Mostrar la tabla con los postres -->
        <table class="ui celled table" id="postresTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Preparacion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($postres as $postre)
                        <tr>
                            <td>{{ $postre->id }}</td>
                            <td>
                                @if($postre->imagen)
                                    <img src="{{ asset('imagenes_postres/' . $postre->imagen) }}"  style="max-width: 100px; max-height: 100px;">
                                @endif
                            </td>
                            <td>{{ $postre->nombre }}</td>
                            <td>{{ $postre->preparacion }}</td>
                            <td>
                                <div class="ui buttons space">
                                    <a href="{{ route('postres.show', $postre->id) }}" class="ui teal button">Show</a>
                                    <a href="{{ route('postres.edit', $postre->id) }}" class="ui green button">Editar</a>
                                    <form action="{{ route('postres.destroy', $postre->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="ui red button" type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar este postre?')">Eliminar</button>
                                    </form>
                                </div>                                
                            </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                const searchText = $(this).val().toLowerCase();
                $('#postresTable tbody tr').each(function() {
                    const text = $(this).text().toLowerCase();
                    if (text.indexOf(searchText) === -1) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                });
            });
        });
    </script>
@endsection
