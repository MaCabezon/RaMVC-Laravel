@extends('layouts.app')
@section('content')
    
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($eventos, ['route' => ['eventos.update', $eventos->id], 'method' => 'patch']) !!}

                        @include('eventos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection