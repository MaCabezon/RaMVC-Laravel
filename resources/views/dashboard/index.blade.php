
@extends('layouts.app')
@section('content')

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('dashboard.table')
                    <!--
                      //Recogemos los datos enviados por el DashboardController con la variable $vista
                      foreach ($vista as $key => $value) {
                        foreach ($value as $key2 => $value2) {

                          // Este foreach trae los datos de cada alumno en un array


                          if ($key2=='Evento') {
                            echo $value2;
                            echo "</br>";
                          }

                          // Filtrar imagen por activado/desactivado/pendiente

                          // Agrupar por asignatura


                        }
                      }
                     -->
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection
