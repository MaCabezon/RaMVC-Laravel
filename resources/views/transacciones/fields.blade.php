<!-- Persona Field -->
<div class="form-group col-sm-6">
    {!! Form::label('persona', 'Persona:') !!}
    {!! Form::text('persona', null, ['class' => 'form-control']) !!}
</div>

<!-- Idevento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idEvento', 'Id evento:') !!}
    {!! Form::number('idEvento', null, ['class' => 'form-control']) !!}
</div>

<!-- Validado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('validado', 'Validado:') !!}
    {!! Form::text('validado', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('transacciones.index') !!}" class="btn btn-default">Cancelar</a>
</div>
