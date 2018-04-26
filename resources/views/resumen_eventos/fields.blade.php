<div id="eventos">

<div class="col-sm-5" id="contenedor_show">
	 <h1 id="titulos">Resumen Eventos</h1>
<!-- Idevento Field -->
<div class="form-group col-sm-12">
    {!! Form::label('idEvento', 'Id evento:') !!}
    {!! Form::number('idEvento', null, ['class' => 'form-control']) !!}
</div>

<!-- Fechaevento Field -->
<div class="form-group col-sm-12">
    {!! Form::label('fechaEvento', 'Fecha evento:') !!}
    {!! Form::date('fechaEvento', null, ['class' => 'form-control']) !!}
</div>

<!-- Horas Field -->
<div class="form-group col-sm-12">
    {!! Form::label('horas', 'Horas:') !!}
    {!! Form::number('horas', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12" id="resumen_evento_botones">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('resumenEventos.index') !!}" class="btn btn-default">Cancelar</a>
</div>
</div>