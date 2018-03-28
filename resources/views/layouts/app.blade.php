<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
   <link href="{{ asset('css/webService.css') }}" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="{{ asset('js//bootstrap.min.js') }}"></script>
  <script>
    
    $(document).ready(function () {

                    (function ($) {

                        $('#filtrar').keyup(function () {

                            var rex = new RegExp($(this).val(), 'i');
                            $('.buscar tr').hide();
                            $('.buscar tr').filter(function () {
                                return rex.test($(this).text());
                            }).show();

                        });

                    }(jQuery));

                });
  </script>
</head>
<body>
  <nav class="navbar navbar-default col-lg-12">
  <div class="container-fluid col-lg-12">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header col-lg-1" id="navuno">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     <a id="logo" class="navbar-brand col-lg-1" href="home" style="margin-bottom: 10px; margin-top: 10px;"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse col-lg-11" id="navdos" style="padding-left: 0px;margin-top: 20px;">
      <ul class="nav navbar-nav">

        <form class="navbar-form navbar-left">
          <div class="form-group">
            <input id="filtrar"  type="text" class="form-control" placeholder="Introduzca dato a buscar...">
          </div>
      </form>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-stats"></span> Estadísticas</a></li>
         @auth
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administracion <span class="caret"></span></a>
          <ul class="dropdown-menu" >
            <li><a href="eventos">Eventos</a></li>
            <li><a href="resumenAlumnos">Resumen Alumnos</a></li>
            <li><a href="resumenEventos">Resumen Eventos</a></li>
            <!--<li role="separator" class="divider"></li>
            <li><a href="Administracion/Registros">Registros</a></li>-->
          </ul>
        </li>
        <li><a href="reporte">Generar reporte</a></li>
        @endauth
        @guest
          <li><a class="nav-link" href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Log in
          </a></li>
          @else
         <li>
            <a  href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
             <span class="glyphicon glyphicon-log-out"></span> Log Out
           </a>
           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
            </form>
             </li>
             @endguest
     </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
      <div>
        <main class="py-4">
            @yield('content')
        </main>
      </div>
      

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
