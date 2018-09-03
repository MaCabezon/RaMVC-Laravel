
@extends('layouts.app')
@section('content')

<div class="content">
  <div class="clearfix"></div>

  @include('flash::message')

  <div class="clearfix">
    <div id ="encabezado" class="col-lg-12" class="label label-default" >
     <h3>Listado de Eventos</h3>
     <hr/>
   </div>
   <div class="box box-primary">
            <div class="box-body">
                    @include('eventos.table')
            </div>
        </div>

 </div>
</div>

 @endsection
