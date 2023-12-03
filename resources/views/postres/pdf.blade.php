<!DOCTYPE html>
<html>
<head>
    <title>PDF Postres</title>
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
        <h2>POSTRES</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Preparación</th>
                </tr>
            </thead>
            <tbody>
                @foreach($postres as $postre)
                <tr>
                    <td>{{ $postre->id }}</td>
                    <td>
                        @if($postre->imagen)                        
                            <img src="{{ $postre->imagen }}" style="max-width: 100px; max-height: 100px;">
                        @endif
                    </td>
                    <td>{{ $postre->nombre }}</td>
                    <td>{{ $postre->preparacion }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
