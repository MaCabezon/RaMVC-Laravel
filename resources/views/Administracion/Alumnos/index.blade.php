<!DOCTYPE html>
<html lang="en">
<head>
  <title>Alumnos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
   <link href="{{ asset('css/webService.css') }}" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="{{ asset('js//bootstrap.min.js') }}"></script>
 
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
     <a id="logo" class="navbar-brand col-lg-1" href="" style="margin-bottom: 10px; margin-top: 10px;"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse col-lg-11" id="navdos" style="padding-left: 0px;margin-top: 20px;">
      <ul class="nav navbar-nav">
       
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Buscar alumno...">
        </div>
      </form>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-stats"></span> Estadísticas</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administracion <span class="caret"></span></a>
          <ul class="dropdown-menu" >
            <li><a href="Alumnos">Alumnos</a></li>
            <li><a href="Materias">Materias</a></li>
            <li><a href="Profesores">Profesores</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="Registros">Registros</a></li>
          </ul>
        </li>
        <li><a href="Reportes">Generar reporte</a></li>
         <li>
            <a  href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
             <span class="glyphicon glyphicon-log-out"></span> Log Out
           </a>
           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
            </form>
             </li>
     </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

        
  <div id ="encabezado" class="col-lg-12" class="label label-default" >
         <h3>Listado de Alumnos</h3>
         <hr/>
      </div>
      
      <div class="container" >
        <div class="row"></div>
          <div>        
         <table  align="center" class="col- table table-striped  table-hover table-dark table-sm table-responsive">
            <thead >
               <tr class = "tabletitles" height = "55">
                  <th class="col-lg-4" >Nombre</th>
                  <th colspan="5" class="col-lg-1">Edicion<a  class="glyphicon  plus btn-sm glyphicon-plus"  onClick="openDialog('popupAlumno')" /></th>
               </tr>
            </thead>
            <tbody class="tabla">


            @foreach($alumnos as $alumno) 
              <tr>
                 <td>{{$alumno->nombreAlumno}}</td>
                 <td colspan='2'>
                  <a href="{{route('Alumnos.edit', $alumno->id )}}" class="btn btn-info glyphicon glyphicon-edit"></a>
                  <a class="btn btn-danger glyphicon glyphicon-trash" href="{{route('Alumnos.destroy', $alumno->id )}}" onclick="event.preventDefault();document.getElementById('form').submit();"> </a>
                  {{ Form :: open([ 'method' => 'delete', 'id'=>'form','route'=>['Alumnos.destroy',$alumno->id]])}}
                 
                  {{ Form::close()}}
                </td>
                 
               </tr>
             @endforeach 
              
               
              
            </tbody>
         </table>
          </div>
         

      </div>
    

</body>
</html>
