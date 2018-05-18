<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Asistencias Uneatlantico') }}</title>

    <!-- Styles -->
    <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link href="{{ asset('css/webService.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src=" https://code.highcharts.com/modules/exporting.js"></script>





    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
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
     <a id="logo" class="navbar-brand col-lg-1" href="{{ action('HomeController@index') }}" style="margin-bottom: 10px; margin-top: 10px;"></a>

    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse col-lg-11" id="navdos" style="padding-left: 0px;margin-top: 20px;">
      <ul class="nav navbar-nav">
         @auth

        <form class="navbar-form navbar-left">
          <div class="form-group">
            <input id="filtrar"  type="text" class="form-control" placeholder="Introduzca dato a buscar...">
          </div>
      </form>
       @endauth

      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ action('HighchartController@highchart') }}"><span class="glyphicon glyphicon-stats"></span> Estadísticas</a></li>
        <li><a href="{{ action('DashboardController@index') }}"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
        @auth       
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administracion <span class="caret"></span></a>
          <ul class="dropdown-menu" >
          @can('eventos-list')
            <li><a href="{{ action('EventosController@index') }}">Eventos</a></li>
          @endcan  
          @can('resumenAlumnos-list')
            <li><a href="{{ action('ResumenAlumnosController@index') }}">Resumen Alumnos</a></li>
          @endcan  
          @can('resumenEventos-list')
            <li><a href="{{ action('ResumenEventosController@index') }}">Resumen Eventos</a></li>
          @endcan  
          @can('transacciones-list')
            <li><a href="{{ action('TransaccionesController@index') }}">Transacciones</a></li>
          @endcan  
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Generar Reporte <span class="caret"></span></a>
          <ul class="dropdown-menu" >           
           <li> <a href="reporteTable">Visualizar reporte</a></li>
           <li> <a href="ResumenAlumnos@excel">Descargar reporte</a></li>
          </ul>  
        </li>
        @endauth
        @guest
          <li><a class="nav-link" href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Log in
          </a></li>
        @endguest
        @auth
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          @if($user = \Auth::user())
                    {{ stristr($user->email, '@', true)  }} <span class="caret"></span>
          @endif 
        </a>
            <ul class="dropdown-menu" >
              @can('user-list')
                <li><a href="{{ action('UserController@index') }}">Usuario</a></li>
              @endcan  
              @can('role-list')
                <li><a href="{{ action('RoleController@index') }}">Roles</a></li>
              @endcan
              @can('permissions-list')
                <li><a href="{{ action('PermissionController@index') }}">Permisos</a></li>
              @endcan   
                <li>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                </li>
                
            </ul>
 </li>
      @endauth
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
