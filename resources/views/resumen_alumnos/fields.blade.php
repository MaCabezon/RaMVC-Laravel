<!-- Persona Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idAlumno', 'Persona:') !!}
    {!! Form::text('idAlumno', null, ['class' => 'form-control']) !!}
</div>

<!-- Idevento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idEvento', 'Id evento:') !!}
    {!! Form::number('idEvento', null, ['class' => 'form-control']) !!}
</div>

<!-- Fechaevento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fechaEvento', 'Fecha evento:') !!}
    {!! Form::date('fechaEvento', null, ['class' => 'form-control']) !!}
</div>

<!-- Horas Field -->
<div class="form-group col-sm-6">
    {!! Form::label('horas', 'Horas:') !!}
    {!! Form::number('horas', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('resumenAlumnos.index') !!}" class="btn btn-default">Cancelar</a>
</div>
