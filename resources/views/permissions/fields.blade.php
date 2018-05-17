<div id="eventos">

    <!-- Abreviatura Field -->
    <div class="col-sm-4" id="contenedor">
        <h1 id="titulos">Permisos</h1>
        <div class="eventoVistas form-group col-sm-12">
            {!! Form::label('name', 'Nombre:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="eventoVistas form-group col-sm-12">
         @if(!$roles->isEmpty())

        <h4>Asignar rol para el permiso</h4>

        @foreach ($roles as $role) 
            {{ Form::checkbox('roles[]',  $role->id ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach

        @endif
        </div>
        
        <!-- Submit Field -->
        <div class="form-group col-sm-12" id="evento_botones">
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
            <a href="{!! route('roles.index') !!}" class="btn btn-default">Cancelar</a>
            
        </div>
        
    </div>

</div>

