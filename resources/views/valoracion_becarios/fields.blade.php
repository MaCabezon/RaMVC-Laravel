<!-- Idalumno Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idAlumno', 'Idalumno:') !!}
    {!! Form::text('idAlumno', null, ['class' => 'form-control']) !!}
</div>

<!-- Curso Field -->
<div class="form-group col-sm-6">
    {!! Form::label('curso', 'Curso:') !!}
    {!! Form::text('curso', null, ['class' => 'form-control']) !!}
</div>

<!-- Formatrabajo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('formaTrabajo', 'Formatrabajo:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('formaTrabajo', false) !!}
        {!! Form::checkbox('formaTrabajo', '1', null) !!} 1
    </label>
</div>

<!-- Actitud Field -->
<div class="form-group col-sm-6">
    {!! Form::label('actitud', 'Actitud:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('actitud', false) !!}
        {!! Form::checkbox('actitud', '1', null) !!} 1
    </label>
</div>

<!-- Manejotecnologia Field -->
<div class="form-group col-sm-6">
    {!! Form::label('manejoTecnologia', 'Manejotecnologia:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('manejoTecnologia', false) !!}
        {!! Form::checkbox('manejoTecnologia', '1', null) !!} 1
    </label>
</div>

<!-- Adaptacion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('adaptacion', 'Adaptacion:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('adaptacion', false) !!}
        {!! Form::checkbox('adaptacion', '1', null) !!} 1
    </label>
</div>

<!-- Responsabilidad Field -->
<div class="form-group col-sm-6">
    {!! Form::label('responsabilidad', 'Responsabilidad:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('responsabilidad', false) !!}
        {!! Form::checkbox('responsabilidad', '1', null) !!} 1
    </label>
</div>

<!-- Cumplimientohoras Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cumplimientoHoras', 'Cumplimientohoras:') !!}
    {!! Form::text('cumplimientoHoras', null, ['class' => 'form-control']) !!}
</div>

<!-- Materias Field -->
<div class="form-group col-sm-6">
    {!! Form::label('materias', 'Materias:') !!}
    {!! Form::text('materias', null, ['class' => 'form-control']) !!}
</div>

<!-- Annio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('annio', 'Annio:') !!}
    {!! Form::text('annio', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('valoracionBecarios.index') !!}" class="btn btn-default">Cancel</a>
</div>
