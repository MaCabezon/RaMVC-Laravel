<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $transacciones->id !!}</p>
</div>

<!-- Persona Field -->
<div class="form-group">
    {!! Form::label('persona', 'Persona:') !!}
    <p>{!! $transacciones->persona !!}</p>
</div>

<!-- Idevento Field -->
<div class="form-group">
    {!! Form::label('idEvento', 'Id evento:') !!}
    <p>{!! $transacciones->idEvento !!}</p>
</div>

<!-- Fechaevento Field -->
<div class="form-group">
    {!! Form::label('fechaEvento', 'Fecha evento:') !!}
    <p>{!! $transacciones->fechaEvento !!}</p>
</div>

<!-- Fecharegistro Field -->
<div class="form-group">
    {!! Form::label('fechaRegistro', 'Fecha registro:') !!}
    <p>{!! $transacciones->fechaRegistro !!}</p>
</div>

<!-- Tipo Field -->
<div class="form-group">
    {!! Form::label('tipo', 'Tipo:') !!}
    <p>{!! $transacciones->tipo !!}</p>
</div>

<!-- Validado Field -->
<div class="form-group">
    {!! Form::label('validado', 'Validado:') !!}
    <p>{!! $transacciones->validado !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $transacciones->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $transacciones->updated_at !!}</p>
</div>
