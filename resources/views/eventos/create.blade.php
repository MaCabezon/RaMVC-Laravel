@extends('layouts.app')

@section('content')
<<<<<<< HEAD
<<<<<<< HEAD
=======
    
>>>>>>> ac1e5755652aa1d38638165cc047e460b016b8fa
=======

>>>>>>> a3518e1c44b7a46ea18cce6da6d87215f80936f5
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
