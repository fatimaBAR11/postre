<!DOCTYPE html>
<html>
<head>
    <title>Listado de Ordenes</title>
    <style>
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        td[colspan="4"] {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Listado de Ordenes</h2>
        <table>
            <thead>
                <tr>
                    <th>Estatus</th>
                    <th>ID Orden</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ordenes as $estatus => $ordenes)
                    <tr>
                        <td colspan="3"><strong>{{ ucfirst($estatus) }}</strong></td>
                    </tr>
                    @foreach ($ordenes as $orden)
                        <tr>
                            <td>{{ ucfirst($estatus) }}</td>
                            <td>{{ $orden->id }}</td>
                            <td>{{ $orden->fecha }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
