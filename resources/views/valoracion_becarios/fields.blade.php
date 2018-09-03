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
    {!! Form::select('formaTrabajo', $valores, null, array('class' => 'form-control')) !!}
    
</div>

<!-- Actitud Field -->
<div class="form-group col-sm-6">
    {!! Form::label('actitud', 'Actitud:') !!}    
    {!! Form::select('actitud', $valores, null, array('class' => 'form-control')) !!}
    
</div>

<!-- Manejotecnologia Field -->
<div class="form-group col-sm-6">
    {!! Form::label('manejoTecnologia', 'Manejotecnologia:') !!}
    {!! Form::select('manejoTecnologia', $valores, null, array('class' => 'form-control')) !!}
</div>

<!-- Adaptacion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('adaptacion', 'Adaptacion:') !!}
    {!! Form::select('adaptacion', $valores, null, array('class' => 'form-control')) !!}
</div>

<!-- Responsabilidad Field -->
<div class="form-group col-sm-6">
    {!! Form::label('responsabilidad', 'Responsabilidad:') !!}
    {!! Form::select('responsabilidad', $valores, null, array('class' => 'form-control')) !!}
</div>

<!-- Cumplimientohoras Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cumplimientoHoras', 'Cumplimientohoras:') !!}    
    {!! Form::textarea('cumplimientoHoras',null,['class'=>'form-control', 'rows' => 2, 'cols' => 40]) !!}
</div>

<!-- Materias Field -->
<div class="form-group col-sm-6">
    {!! Form::label('materias', 'Materias:') !!}
    {!! Form::textarea('materias',null,['class'=>'form-control', 'rows' => 2, 'cols' => 40]) !!}
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
