<!-- Idevento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idEvento', 'Idevento:') !!}
    {!! Form::number('idEvento', null, ['class' => 'form-control']) !!}
</div>

<!-- Fechaevento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fechaEvento', 'Fechaevento:') !!}
    {!! Form::date('fechaEvento', null, ['class' => 'form-control']) !!}
</div>

<!-- Horas Field -->
<div class="form-group col-sm-6">
    {!! Form::label('horas', 'Horas:') !!}
    {!! Form::number('horas', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('resumenEventos.index') !!}" class="btn btn-default">Cancel</a>
</div>
