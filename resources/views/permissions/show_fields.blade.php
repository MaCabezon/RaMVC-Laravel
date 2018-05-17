<div id="eventos">
    <div class="col-sm-5" id="contenedor_show">
    <h1 id="titulos">Permiso</h1>
        <div class="eventoVistas form-group col-sm-12">
            {!! Form::label('name', 'Nombre:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="eventoVistas form-group col-sm-12">
         @if(!$roles->isEmpty())

        <h4>Permisos asignados a</h4>

        @foreach ($roles as $role) 
            {{ Form::checkbox('roles[]',  $role->id ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach

        @endif     

        
</div>
