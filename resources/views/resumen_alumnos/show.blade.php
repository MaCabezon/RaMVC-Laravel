@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Resumen Alumnos
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('resumen_alumnos.show_fields')
                    <a href="{!! route('resumenAlumnos.index') !!}" class="btn btn-default">Atras</a>
                </div>
            </div>
        </div>
    </div>
@endsection
