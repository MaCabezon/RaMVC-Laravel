
@extends('layouts.app')
@section('content')

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix">
          <div id ="encabezado" class="col-lg-12" class="label label-default" >
                   <h3>Listado de Transacciones</h3>
                   <hr/>
          </div>
          <div class="container">
	           <div class="row">
		             <div class="col-md-12">
		                 <form class="form-inline form-filtro">
                       <div class="form-group">
                         <h6>Fecha inicial</h6>
                         <input type="date" class="form-control" id="fechaInicial" name="fechaInicial" max="<?php $hoy=date('Y-m-d'); echo $hoy; ?>">
                       </div>
                       <div class="form-group">
                         <h6>Fecha final</h6>
                         <input type="date" class="form-control" id="fechaFinal" name="fechaFinal" max="<?php $hoy=date('Y-m-d'); echo $hoy; ?>">
                       </div>
                       <!-- Queda de añadir más filtro -->
                         @php
                          $arrayAlumnos = [];
                          $arrayEventos = [];
                         @endphp

                        @foreach ($transaccionesCompleto as $transaccion)
                          @php
                            $arrayAlumnos[] = $transaccion->idPersona;
                            $arrayEventos[] = $transaccion->nombre;
                            asort($arrayAlumnos);
                            asort($arrayEventos);
                          @endphp
                        @endforeach


                        {!! Form::open(['route' => ['transacciones.index'], 'method' => 'POST']) !!}
                        <div class="form-group">
                          <h6>Alumno</h6>
                          <select name="alumnos" class="form-control">
                            <option value="" disabled selected>-- Seleccione un alumno --</option>
                            @foreach (array_unique($arrayAlumnos) as $key => $value)
                              <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <h6>Materia</h6>
                          <select name="eventos" class="form-control">
                            <option value="" disabled selected>-- Seleccione una materia --</option>
                            @foreach (array_unique($arrayEventos) as $key => $value)
                              <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                        </br>
                        <!-- 'btn btn-primary btn-sm' -->

                          {!! Form::button('Filtrar',['type' => 'submit', 'class' => 'btn btn-primary', 'method' => 'delete']) !!}
                          {!! Form::button('Limpiar',['type' => 'reset', 'class' => 'btn btn-default']) !!}
                        </div>
                        {!! Form::close() !!}

                     </form>
		                 </div>
	                  </div>
                  </div>

        </div>
        <div class="box box-primary">
            <div class="box-body">
              @if($hasFilter==true)
                  @include('transacciones.table')
              @endif
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection
