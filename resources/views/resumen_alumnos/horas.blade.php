@extends('layouts.app')

@section('content')



<div class=" col-lg-4 w3-dark-grey row" style="background-postion=center;">

<div class="w3-container w3-center">
  
  <div id ='tarjeta' alt="Avatar" class="col-lg-6" ></div>
  <div class="col-lg-7">
  <h4>Resumen de Horas</h4>
    <p>Horas Diarias   :  {{$horasDiarias }}  </p>
    <p>Horas Semanales :  {{$horasSemanales }}  </p>
    <p>Horas Mensuales :  {{$horasMensuales }}  </p>
    <p>Horas Totales   :  {{$horasTotales }}  </p>
</div>
 
</div>

</div>


@endsection