@extends('layouts.app')

@section('content')

<div class="content">
  <div class="clearfix"></div>

  @include('flash::message')

  <div class="clearfix">
      <div id ="encabezado" class="col-lg-12" class="label label-default" >
        <h3>Resumen de Eventos</h3>
        <hr/>
      </div>

      <div class="container">
        <div>
        <div>
            <div class="col-md-8" style="padding-left: 20%; padding-right: 0%">
               <form class="form-inline form-filtro">
                <div class=col-md-12 style="padding-left: 0%">
                  <div class="form-group col-md-6" style="padding-left: 0%">
                     <h6>Fecha inicial</h6>
                     <input type="date" class="form-control" id="fechaInicial" name="fechaInicial" max="<?php $hoy=date('Y-m-d'); echo $hoy; ?>">
                  </div>
                  <div class="form-group col-md-6" style="padding-left: 6%">
                     <h6>Fecha final</h6>
                     <input type="date" class="form-control" id="fechaFinal" name="fechaFinal" max="<?php $hoy=date('Y-m-d'); echo $hoy; ?>">
                  </div>
            </div>
       @php
       $arrayEventos = [];
       @endphp

       @foreach ($resumenEventosCompleto as $resumenEvento)
       @php
       $arrayEventos[] = $resumenEvento->nombre;
       asort($arrayEventos);
       @endphp
       @endforeach


       {!! Form::open(['route' => ['resumenAlumnos.index'], 'method' => 'POST']) !!}


           
           <div class="form-group col-md-12">
             <h6>Materia</h6>
             <select name="eventos" class="form-control">
             <option value="" disabled selected>-- Seleccione una materia --</option>
             @foreach (array_unique($arrayEventos) as $key => $value)
             <option value="{{ $value }}">{{ $value }}</option>
             @endforeach
             </select>
           </div>
      </div>


      <div class="form-group col-md-2" style="padding-left: 2%;padding-bottom: 0%;padding-top: 3.5%;float: left;">
      </br>
      <!-- 'btn btn-primary btn-sm' -->

      {!! Form::button('Filtrar',['type' => 'submit', 'class' => 'btn btn-primary', 'method' => 'delete']) !!}

      {!! Form::button('Limpiar',['type' => 'reset', 'class' => 'btn btn-default']) !!}
    </div>


    {!! Form::close() !!}
    
      </div>
    </div>
    </form>
</div>
</div>
</div>


<div class="box box-primary">
  <div class="box-body">
    @if($hasFilter==true)
    @include('resumen_eventos.table')
    @endif
  </div>
</div>
<div class="text-center">

</div>
</div>
@endsection
