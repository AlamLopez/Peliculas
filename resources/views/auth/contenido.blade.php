<!DOCTYPE html>
<html lang="es">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="SISTEMA DE ADMINISTRACION DE PELICULAS">
        <meta name="author" content="Alam Lopez">
        <meta name="keyword" content="Sistema de Administracion de Peliculas">

        <title>Sistema de Administracion de Peliculas</title>
        <link href="css/plantilla.css" rel="stylesheet">

    </head>

    <body class="app flex-row align-items-center">
        <div class="container">
            @yield('login')
        </div>

        <!-- Bootstrap and necessary plugins -->
        <script src="js/app.js"></script>
        <script src="js/plantilla.js"></script>

        <script>
            $(document).ready(function(){
                
                $('.dropdown-toggle').dropdown();


                $('form').keypress(function(e){   
                    if(e == 13){
                    return false;
                    }
                });

                $('input').keypress(function(e){
                    if(e.which == 13){
                    return false;
                    }
                });
            });
        </script>

    </body>
</html>