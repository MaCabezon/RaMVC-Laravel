@extends('layouts.app')

@section('content')
    <section class="content-header">
        
        
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix">
             <div id ="encabezado" class="col-md-12" class="label label-default" >
                <h3>Valoracion de Becarios</h3>
                 <hr/>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('valoracion_becarios.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

