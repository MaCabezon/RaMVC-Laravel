@extends('layouts.app')

@section('content')

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix">
          <div id ="encabezado" class="col-md-12" class="label label-default" >
           <h3>Reporte</h3>
           <hr/>
         </div>
        </div>

          <div class="container">
           <div>
            <div class="col-md-12" style="padding-left: 10%;margin-bottom: 2%">
              <form class="form-inline form-filtro">
               <div class="col-md-3" style="float: left;">
                 <div class="form-group col-md-12" style="float: left;">
                  <h6>Fecha</h6>
                  <input type="date" class="form-control col-md-2" id="fecha" name="fecha" max="<?php $hoy=date('Y-m-d'); echo $hoy; ?>">
                </div>
              </div>

              @php
                $arrayAlumnos = [];
                $arrayEventos = [];
              @endphp

              @foreach ($reportesCompleto as $reportes)
              @php
                $arrayAlumnos[] = $reportes->Alumno;
                $arrayEventos[] = $reportes->Evento;
                asort($arrayAlumnos);
                asort($arrayEventos);
              @endphp
              @endforeach


              {!! Form::open(['route' => ['reportes.index'], 'method' => 'POST']) !!}
              <div class="col-md-5" >
               <div class="form-group col-md-12" >
                 <h6>Alumno</h6>
                 <select name="alumnos" class="form-control col-md-12">
                   <option value="" disabled selected>-- Seleccione un alumno --</option>
                   @foreach (array_unique($arrayAlumnos) as $key => $value)
                   <option value="{{ $value }}">{{ $value }}</option>
                   @endforeach
                 </select>
               </div>
               <div class="form-group col-md-12">
                 <h6>Materia</h6>
                 <select name="eventos" class="form-control col-md-12">
                   <option value="" disabled selected>-- Seleccione una materia --</option>
                   @foreach (array_unique($arrayEventos) as $key => $value)
                   <option value="{{ $value }}">{{ $value }}</option>
                   @endforeach
                 </select>
               </div>
             </div>

             <div class="form-group 7 col-md-4" style="margin-top: 5%;margin-left: 0%;margin-right: 0%">
             </br>
               {!! Form::button('Filtrar',['type' => 'submit', 'class' => 'btn btn-primary', 'method' => 'delete']) !!}
               {!! Form::button('Limpiar',['type' => 'reset', 'class' => 'btn btn-default']) !!}
             </div>
           </div>
           {!! Form::close() !!}

         </form>
       </div>
       </div>
        <div class="box box-primary">
          <div class="box-body">
            @if($hasFilter==true)
              @include('reportes.table')
            @endif
          </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection
