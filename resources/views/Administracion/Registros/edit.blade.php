<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style>
         .na,.na a{
       background-color: #0174DF !important;
       color:white !important;
     }

         th {
       text-align: center !important;
       background-color: #0174DF !important;
       color:white;
         }
     #filtrar{
       height:20px;
       margin-top:14px !important;
       width:500px;

     }




      </style>
</head>
<body>

<nav class="navbar na col-lg-12  ">
  <div class="container-fluid col-lg-12">
    <div class="navbar-header ">
      <button type="button" class="glyphicon glyphicon-align-justify navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">WebService</a>
    </div>
    <div class="collapse navbar-collapse " id="myNavbar">

      <ul class="nav navbar-nav navbar-right ">
        <!--<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>-->
    <li ><input id="filtrar" type="text" class="  form-control"   placeholder="Introduzca el alumno a buscar" /></li>
        <li class="active"><a href="#">Estadísticas</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Administración <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="Alumnos">Alumnos</a></li>
            <li><a href="Materias">Materias</a></li>
            <li><a href="Profesores">Profesores</a></li>
      <li><a href="Registros">Registros</a></li>
          </ul>
        <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Login Out</a></li>
      </ul>
    </div>
  </div>
</nav>






</body>
</html>
