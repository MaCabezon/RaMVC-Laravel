<div id="eventos">
    <div class="col-sm-5" id="contenedor_show">
     <h1 id="titulos">Eventos</h1>
     <!-- Id Field -->
     <div class="eventoVistas form-group col-sm-6">
        {!! Form::label('id', 'Id:') !!}
        <p>{!! $eventos->id !!}</p>
    </div>

    <!-- Abreviatura Field -->
    <div class="eventoVistas form-group col-sm-6" >
        {!! Form::label('abreviatura', 'Abreviatura:') !!}
        <p>{!! $eventos->abreviatura !!}</p>
    </div>

    <!-- Nombre Field -->
    <div class="eventoVistas form-group col-sm-12" >
        {!! Form::label('nombre', 'Nombre:') !!}
        <p>{!! $eventos->nombre !!}</p>
    </div>

    <!-- Grupo Field -->
    <div class="eventoVistas form-group col-sm-6">
        {!! Form::label('grupo', 'Grupo:') !!}
        <p>{!! $eventos->grupo !!}</p>
    </div>

    <!-- Nombreprofesor Field -->
    <div class="eventoVistas form-group col-sm-6" >
        {!! Form::label('nombreProfesor', 'Nombre profesor:') !!}
        <p>{!! $eventos->nombreProfesor !!}</p>
    </div>

    <!-- Created At Field -->
    <div class="eventoVistas form-group col-sm-6">
        {!! Form::label('created_at', 'Created At:') !!}
        <p>{!! $eventos->created_at !!}</p>
    </div>

    <!-- Updated At Field -->
    <div class="eventoVistas form-group col-sm-6" >
        {!! Form::label('updated_at', 'Updated At:') !!}
        <p>{!! $eventos->updated_at !!}</p>
    </div>

    <div class="form-group col-sm-2" style="padding-left: 20px" id="evento_back">
                   
    <a href="{!! route('eventos.index') !!}" class="btn btn-default" style="background-color: #048cd4; color: white" >Atras</a>
  
    </div>
</div>
