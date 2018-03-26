@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Transacciones
        </h1>
   </section>
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