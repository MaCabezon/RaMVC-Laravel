@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Resumen Eventos
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('resumen_eventos.show_fields')
                    <a href="{!! route('resumenEventos.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
