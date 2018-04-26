<div id="eventos">
<div class="col-sm-5" id="contenedor_show">
    <h1 id="titulos">Resumen Alumnos</h1>
    <!-- Id Field -->
    <div class="form-group col-sm-12" id="evento_uno">
        {!! Form::label('id', 'Id:') !!}
        <p>{!! $resumenAlumnos->id !!}</p>
    </div>

    <!-- Persona Field -->
    <div class="form-group col-sm-12" id="evento_dos">
        {!! Form::label('persona', 'Persona:') !!}
        <p>{!! $resumenAlumnos->persona !!}</p>
    </div>

    <!-- Idevento Field -->
    <div class="form-group col-sm-12" id="evento_tres">
        {!! Form::label('idEvento', 'Id evento:') !!}
        <p>{!! $resumenAlumnos->idEvento !!}</p>
    </div>

    <!-- Fechaevento Field -->
    <div class="form-group col-sm-6" id="evento_cuatro">
        {!! Form::label('fechaEvento', 'Fecha evento:') !!}
        <p>{!! $resumenAlumnos->fechaEvento !!}</p>
    </div>

    <!-- Horas Field -->
    <div class="form-group col-sm-6" id="evento_cinco">
        {!! Form::label('horas', 'Horas:') !!}
        <p>{!! $resumenAlumnos->horas !!}</p>
    </div>

    <!-- Created At Field -->
    <div class="form-group col-sm-6" id="evento_seis">
        {!! Form::label('created_at', 'Created At:') !!}
        <p>{!! $resumenAlumnos->created_at !!}</p>
    </div>

    <!-- Updated At Field -->
    <div class="form-group col-sm-6" >
        {!! Form::label('updated_at', 'Updated At:') !!}
        <p>{!! $resumenAlumnos->updated_at !!}</p>
    </div>

    <div class="col-sm-2" style="padding-left: 20px" id="evento_back">
        <a href="{!! route('resumenAlumnos.index') !!}" class="btn btn-default" style="background-color: #048cd4; color: white">Atras</a>
    </div>
</div>