<div id="eventos">

    <!-- Abreviatura Field -->
    <div class="col-sm-4" id="contenedor">
        <h1 id="titulos">Eventos</h1>
        <div class="eventoVistas form-group col-sm-12">
            {!! Form::label('abreviatura', 'Abreviatura:') !!}
            {!! Form::text('abreviatura', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Nombre Field -->
        <div class="eventoVistas form-group col-sm-12">
            {!! Form::label('nombre', 'Nombre:') !!}
            {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Grupo Field -->
        <div class="eventoVistas form-group col-sm-12">
            {!! Form::label('grupo', 'Grupo:') !!}
            {!! Form::text('grupo', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Nombreprofesor Field -->
        <div class="eventoVistas form-group col-sm-12">
            {!! Form::label('nombreProfesor', 'Nombre profesor:') !!}
            {!! Form::text('nombreProfesor', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Submit Field -->
        <div class="form-group col-sm-12" id="evento_botones">
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
            <a href="{!! route('eventos.index') !!}" class="btn btn-default">Cancelar</a>
            <a href="import" class="btn btn-default" style="background-color: #40C52D; border-color: #1E8110;">Importar CSV</a>
        </div>

    </div>

</div>

