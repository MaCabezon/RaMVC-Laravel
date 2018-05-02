<div id="eventos">
    <!-- idPersona Field -->
    <div class="col-sm-4" id="contenedor">
        <h1 id="titulos">Transacciones</h1>
        <div class="form-group col-sm-12" id="evento_uno">
            {!! Form::label('idPersona', 'Persona:') !!}
            {!! Form::text('idPersona', null, ['class' => 'form-control']) !!}
        </div>

        <!-- idEvento Field -->
        <div class="form-group col-sm-12" id="evento_dos">
            {!! Form::label('idEvento', 'Evento:') !!}
            {!! Form::text('idEvento', null, ['class' => 'form-control']) !!}
        </div>
        <!-- fechaEvento Field -->
        <div class="form-group col-sm-12" id="evento_dos">
            {!! Form::label('fechaEvento', 'Fecha Evento:') !!}
            {!! Form::text('fechaEvento', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Tipo Field -->
        <div class="form-group col-sm-12" id="evento_tres">
            {!! Form::label('tipo', 'Tipo:') !!}
            {!! Form::text('tipo', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Validado Field -->
        <div class="form-group col-sm-12" id="evento_cuatro">
            {!! Form::label('validado', 'Valiado:') !!}
            {!! Form::text('validado', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Submit Field -->
        <div class="form-group col-sm-12" id="evento_botones">
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
            <a href="{!! route('transacciones.index') !!}" class="btn btn-default">Cancelar</a>
           
        </div>

    </div>

</div>

