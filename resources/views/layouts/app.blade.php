<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Asistencias Uneatlantico') }}</title>

<<<<<<< HEAD
  <!-- Styles -->
  <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
 
  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
  <link href="{{ asset('css/webService.css') }}" rel="stylesheet">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
=======
    <!-- Styles -->
    <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
    <!--Link del Datepicker-->
    <link href="/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link href="{{ asset('css/webService.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
>>>>>>> 7d7df26253a9ca59921c33d1ebb88cb8de37bbe5

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

  <nav class="navbar navbar-default navbar-expand-lg ">
       <div class="Contenedor_nav col-lg-12"> 
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="col-lg-1"> 
        <a id="logo" class="navbar-brand " href="{{ action('HomeController@index') }}" style="margin-bottom: 10px; margin-top: 10px;margin-left: 1%;"></a>
      </div>

<<<<<<< HEAD
      <div class="col-lg-7" style="padding-left: 0%; padding-right:0%;margin-left: 0%; margin-right: 0%; margin-top: 20px;float: left;">
        @auth
         <form class="navbar-form navbar-right" style="border:none;">
          <input id="filtrar"  type="text" class="form-control" placeholder="Introduzca dato a buscar...">
         </form>
        @endauth
      </div>
      

     <div>
          <button type="button" class="navbar-toggle collapsed sidenav" data-toggle="collapse" data-target="#navdos" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation" style= "margin-top:5%; ">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse col-lg-4" id="navdos" style="padding-left: 0px;margin-top: 20px; float: right;">
        
        

       <ul class="nav navbar-nav navbar-right">
              <li>
                <a href="graficas" class="opcion"><span class="glyphicon glyphicon-stats"></span> Estadísticas</a>
              </li>

              <li>
                <a href="dashboard" class="opcion"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a>
              </li>
                   @auth
              <li class="dropdown">
                    <a href="#" class="dropdown-toggle opcion" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administracion <span class="caret"></span></a>
                <ul class="dropdown-menu">
                      @if(\Auth::user()->type!='user')
                          <li><a href="{{ action('EventosController@index') }}" style="color:white">Eventos</a></li>
                          @endif  
                          <li><a href="{{ action('ResumenAlumnosController@index') }}" style="color:white">Resumen Alumnos</a></li>
                          <li><a href="{{ action('ResumenEventosController@index') }}" style="color:white">Resumen Eventos</a></li>
                          <li><a href="{{ action('TransaccionesController@index') }}" style="color:white">Transacciones</a></li>
                </ul>
              </li>
              <li class="dropdown">
              <a href="#" class="dropdown-toggle opcion" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Generar Reporte <span class="caret"></span></a>
                <ul class="dropdown-menu">           
                  <li> <a href="reporteTable" style="color:white">Visualizar reporte</a></li>
                  <li> <a href="reporte" style="color:white">Descargar reporte</a></li>
                </ul>  
              </li>
         @endauth
         @guest

              <li><a class="nav-link" href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Log in</a>
              </li>
         @endguest
         @auth
         <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle opcion" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color:white">
            @if($user = \Auth::user())
            {{ stristr($user->email, '@', true)  }} <span class="caret"></span>
            @endif
          </a>

          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item opcion" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST"  style="display: none;">
              @csrf
            </form>
          </div>
        </li>
        @endauth
      </ul>
   </div>  
=======
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
           <li> <a href="{{ action('ResumenAlumnosController@excel') }}">Descargar reporte</a></li>
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
>>>>>>> 7d7df26253a9ca59921c33d1ebb88cb8de37bbe5
  </div><!-- /.container-fluid -->
</nav>

  <main class="py-4">
    @yield('content')
  </main>
</div>


<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
