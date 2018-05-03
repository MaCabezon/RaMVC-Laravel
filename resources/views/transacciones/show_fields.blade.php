<div id="eventos">
    <div class="col-sm-5" id="contenedor_show">
     <h1 id="titulos">Transacciones</h1>
     <!-- Id Field -->
     <div class="form-group col-sm-6" id="evento_uno">
        {!! Form::label('id', 'Id:') !!}
        <p>{!! $transacciones->id !!}</p>
    </div>

    <!-- idPersona Field -->
    <div class="form-group col-sm-6" >
        {!! Form::label('idPersona', 'Persona:') !!}
        <p>{!! $transacciones->idPersona !!}</p>
    </div>

    <!-- idEvento Field -->
    <div class="form-group col-sm-12" id="evento_tres">
        {!! Form::label('idEvento', 'idEvento:') !!}
        <p>{!! $transacciones->idEvento !!}</p>
    </div>

    <!-- fechaEvento Field -->
    <div class="form-group col-sm-6" id="evento_cuatro">
        {!! Form::label('fechaEvento', 'Fecha:') !!}
        <p>{!! $transacciones->fechaEvento !!}</p>
    </div>

    <!-- Tipo Field -->
    <div class="form-group col-sm-6" >
        {!! Form::label('tipo', 'Tipo:') !!}
        <p>{!! $transacciones->tipo !!}</p>
    </div>

    <!-- Created At Field -->
    <div class="form-group col-sm-6" id="evento_seis">
        {!! Form::label('created_at', 'Created At:') !!}
        <p>{!! $transacciones->created_at !!}</p>
    </div>

    <!-- Updated At Field -->
    <div class="form-group col-sm-6" >
        {!! Form::label('updated_at', 'Updated At:') !!}
        <p>{!! $transacciones->updated_at !!}</p>
    </div>

    <div class="form-group col-sm-2" style="padding-left: 20px" id="evento_back">
                   
    <a href="{!! route('transacciones.index') !!}" class="btn btn-default" style="background-color: #048cd4; color: white" >Atras</a>
  
    </div>
</div>
