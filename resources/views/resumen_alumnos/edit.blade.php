@extends('layouts.app')

@section('content')
   
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($resumenAlumnos, ['route' => ['resumenAlumnos.update', $resumenAlumnos->id], 'method' => 'patch']) !!}

                        @include('resumen_alumnos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection