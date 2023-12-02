@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Menu
            <a href="{{ route('platillos.create') }}" class="ui green button" style="float: right;">NUEVO PLATILLO</a>
            <a href="{{ route('platillos.pdf.generate') }}" class="ui blue button" style="float: right; margin-right: 10px;" target="_blank">PDF</a>
        </h2>
        <!-- Input de búsqueda -->
        <div class="ui input" style="margin-bottom: 10px;"><br>
            <input type="text" id="searchInput" placeholder="Buscar platillo...">
        </div>
        <!-- Mostrar la tabla con los platillos -->
        <table class="ui celled table" id="platillosTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($platillos as $platillo)
                <tr>
                    <td>{{ $platillo->id }}</td>
                    <td>
                        @if($platillo->imagen)
                            <img src="{{ asset('carpeta_imagenes/' . $platillo->imagen) }}" alt="{{ $platillo->name }}" style="max-width: 100px; max-height: 100px;">
                        @endif
                    </td>
                    <td>{{ $platillo->name }}</td>
                    <td>{{ $platillo->categoria->name }}</td>
                    <td>${{ number_format($platillo->precio, 2) }}</td>
                    <td>
                        <!-- Enlaces a editar y eliminar -->
                        <div class="ui buttons">
                            <a href="{{ route('platillos.edit', $platillo->id) }}" class="ui blue button">Editar</a>
                            <form action="{{ route('platillos.destroy', $platillo->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="ui red button" type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar este platillo?')">Eliminar</button>
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
                $('#platillosTable tbody tr').each(function() {
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
