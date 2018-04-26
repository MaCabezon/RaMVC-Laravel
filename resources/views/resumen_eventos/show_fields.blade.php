<div id="eventos">
<div class="col-sm-4" id="contenedor_show">
<h1 id="titulos">Resumen Eventos</h1>

<!-- Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $resumenEventos->id !!}</p>
</div>

<!-- Idevento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idEvento', 'Id evento:') !!}
    <p>{!! $resumenEventos->idEvento !!}</p>
</div>

<!-- Fechaevento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fechaEvento', 'Fecha evento:') !!}
    <p>{!! $resumenEventos->fechaEvento !!}</p>
</div>

<!-- Horas Field -->
<div class="form-group col-sm-6">
    {!! Form::label('horas', 'Horas:') !!}
    <p>{!! $resumenEventos->horas !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $resumenEventos->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $resumenEventos->updated_at !!}</p>
</div>

<div class="col-sm-5" style="padding-left: 20px" id="evento_back">
<a href="{!! route('resumenEventos.index') !!}" class="btn btn-default" style="background-color: #048cd4; color: white">Atras</a>
</div>

</div>