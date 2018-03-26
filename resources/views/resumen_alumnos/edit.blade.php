@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Resumen Alumnos
        </h1>
   </section>
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