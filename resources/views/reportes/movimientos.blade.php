<html>
    <head>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <style>
            @page {
                font-family: Arial;
            }
        
            body {
                font-family: Arial;
                font-size: 8pt;
            }
        </style>
    </head>
    <body>

        <header style="height: 100px;">        
            <p style="font-size: 12pt;">MOVIMIENTOS</p>
        </header>

        <br><br>

        <main class="main">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr class="bg-danger text-white">
                        <th class="align-middle" style="text-align: center;">No.</th>
                        <th class="align-middle" style="text-align: center;">PELICULA</th>
                        <th class="align-middle" style="text-align: center;">CLIENTE</th>
                        <th class="align-middle" style="text-align: center;">MOVIMIENTO</th>
                        <th class="align-middle" style="text-align: center;">FECHA</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=0
                    @endphp
                    @foreach($data as $item)
                        @php $i ++ @endphp
                        <tr>
                            <td class="align-middle" style="text-align: center;">{{ $i }}</td>
                            <td class="align-middle" style="text-align: center;">{{ $item["pelicula"] }}</td>
                            <td class="align-middle" style="text-align: center;">{{ $item["cliente"] }}</td>
                            <td class="align-middle" style="text-align: center;">{{ $item["movimiento"] }}</td>
                            <td class="align-middle" style="text-align: center;">{{ $item["fecha"] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </main>

        <script src="js/plantilla.js"></script>
    </body>
</html>