@extends('layouts.app')

@section('content')
    
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($resumenEventos, ['route' => ['resumenEventos.update', $resumenEventos->id], 'method' => 'patch']) !!}

                        @include('resumen_eventos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection