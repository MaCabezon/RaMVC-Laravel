@extends('layouts.app')

@section('content')
    
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('resumen_alumnos.show_fields')

                </div>
            </div>
        </div>
    </div>
@endsection
