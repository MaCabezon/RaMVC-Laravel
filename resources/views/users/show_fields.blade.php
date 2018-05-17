<div id="eventos">
    <div class="col-sm-5" id="contenedor_show">
     <h1 id="titulos">Usuario</h1>
    
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

        
    </div>
</div>
