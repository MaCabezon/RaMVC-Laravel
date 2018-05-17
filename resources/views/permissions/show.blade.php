@extends('layouts.app')

@section('content')
    
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                {!! Form::model($permission, ['route' => ['permissions.update', $permission->id], 'method' => 'patch']) !!}

                         @include('permissions.show_fields')

                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
