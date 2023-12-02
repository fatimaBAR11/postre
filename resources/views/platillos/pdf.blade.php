<!DOCTYPE html>
<html>
<head>
    <title>Menu - Platillos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Menu</h2>
        <!-- Mostrar la tabla con los platillos -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach($platillos as $platillo)
                <tr>
                    <td>{{ $platillo->id }}</td>
                    <td>
                        <@if($platillo->imagen)                        
                            <img src="{{ $platillo->imagen }}" style="max-width: 100px; max-height: 100px;">
                        @endif
                    </td>
                    <td>{{ $platillo->name }}</td>
                    <td>{{ $platillo->categoria->name }}</td>
                    <td>${{ number_format($platillo->precio, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
