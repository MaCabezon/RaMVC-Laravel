<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $resumenEventos->id !!}</p>
</div>

<!-- Idevento Field -->
<div class="form-group">
    {!! Form::label('idEvento', 'Id evento:') !!}
    <p>{!! $resumenEventos->idEvento !!}</p>
</div>

<!-- Fechaevento Field -->
<div class="form-group">
    {!! Form::label('fechaEvento', 'Fecha evento:') !!}
    <p>{!! $resumenEventos->fechaEvento !!}</p>
</div>

<!-- Horas Field -->
<div class="form-group">
    {!! Form::label('horas', 'Horas:') !!}
    <p>{!! $resumenEventos->horas !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $resumenEventos->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $resumenEventos->updated_at !!}</p>
</div>
