@extends('layouts.app')

@section('content')
    
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($transacciones, ['route' => ['transacciones.update', $transacciones->id], 'method' => 'patch']) !!}

                        @include('transacciones.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection