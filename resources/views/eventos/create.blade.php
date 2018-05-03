@extends('layouts.app')

@section('content')
<<<<<<< HEAD
=======
    
>>>>>>> ac1e5755652aa1d38638165cc047e460b016b8fa
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'eventos.store']) !!}

                        @include('eventos.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
