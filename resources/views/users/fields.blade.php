<div id="eventos">

    <!-- Abreviatura Field -->
    <div class="col-sm-4" id="contenedor">
        <h1 id="titulos">Usuarios</h1>
        <div class="eventoVistas form-group col-sm-12">
            {!! Form::label('name', 'Nombre:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Nombre Field -->
        <div class="eventoVistas form-group col-sm-12">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::email('email', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Grupo Field -->
        <div class="eventoVistas form-group col-sm-12">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::text('password', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Nombreprofesor Field -->
        <div class="eventoVistas form-group col-sm-12">
            {!! Form::label('confirm-password', 'Confirmar contraseña:') !!}
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
        </div>

        <!-- Submit Field -->
        <div class="form-group col-sm-12" id="evento_botones">
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
            <a href="{!! route('users.index') !!}" class="btn btn-default">Cancelar</a>
            
        </div>
    </div>

</div>

