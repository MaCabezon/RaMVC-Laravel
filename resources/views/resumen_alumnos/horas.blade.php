@extends('layouts.app')

@section('content')



<div class=" col-lg-12" style="background-postion=center;">

<div class="col-lg-3 w3-center " id="contenedor_horas">
  
  <div id ='tarjeta' alt="Avatar" class="col-lg-7" ></div>
  	<div class="col-lg-7" id=horas_>
  		<h4><Strong>Resumen de Horas</Strong></h4>
    	<p>Horas Diarias   :  {{$horasDiarias }}  </p>
    	<p>Horas Semanales :  {{$horasSemanales }}  </p>
    	<p>Horas Mensuales :  {{$horasMensuales }}  </p>
    	<p>Horas Totales   :  {{$horasTotales }}  <spam> / 750 </spam></p>
    </div>
 
  </div>

</div>




@endsection