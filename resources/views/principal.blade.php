<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema Peliculas Laravel Vue Js">
    <meta name="author" content="Incanatoit.com">
    <meta name="keyword" content="Sistema administracion de peliculas Laravel Vue Js, Sistema compras Laravel Vue Js">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>Sistema Administracion de Peliculas</title>
    <!-- Icons -->
    <link href="css/plantilla.css" rel="stylesheet">
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <div id="app">

        @include('plantilla.header')

        <div class="app-body">
            
            @include('plantilla.sidebar')

            <!-- Contenido Principal -->

                @yield('contenido')
            
            <!-- /Fin del contenido principal -->


        </div>

    </div>

    @include('plantilla.footer')

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