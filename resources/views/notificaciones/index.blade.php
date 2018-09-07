@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                {!! Form::open(['route' => 'notificaciones.store']) !!}

                    <div class="form-group">
                        <select class="form-control" name="recipient_id">
                            <option value="">Seleciona el usuario</option>
                            @foreach($users as $user)

                             <option value="{{$user->id}}">{{$user->name}}</option>
            
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                         <textarea name="body" class="form-control" placeholder="Escrine el mensaje"></textarea>
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!} 
                    </div>

                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
