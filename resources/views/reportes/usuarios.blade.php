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
            <p style="font-size: 12pt;">USUARIOS TIPO CLIENTE</p>
        </header>

        <br><br>

        <main class="main">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr class="bg-danger text-white">
                        <th class="align-middle" style="text-align: center;">No.</th>
                        <th class="align-middle" style="text-align: center;">NOMBRE COMPLETO</th>
                        <th class="align-middle" style="text-align: center;">USUARIO</th>
                        <th class="align-middle" style="text-align: center;">EMAIL</th>
                        <th class="align-middle" style="text-align: center;">ROL</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=0
                    @endphp
                    @foreach($data as $item)
                        @php $i ++ @endphp
                        <tr>
                            <td class="align-middle" style="text-align: center;">{{ $i }}</td>
                            <td class="align-middle" style="text-align: center;">{{ $item["usuario"] }}</td>
                            <td class="align-middle" style="text-align: center;">{{ $item["nombrecompleto"] }}</td>
                            <td class="align-middle" style="text-align: center;">{{ $item["email"] }}</td>
                            <td class="align-middle" style="text-align: center;">{{ $item["rol"] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </main>

        <script src="js/plantilla.js"></script>
    </body>
</html>