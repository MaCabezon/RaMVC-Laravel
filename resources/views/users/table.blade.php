<div id ="encabezado" class="col-lg-12" class="label label-default" >
         <h3>Listado de Usuarios</h3>
         <hr/>
</div>

    <div class="container" >
        <div class="row"></div>
          <div>
    <table class="table table-responsive" id="eventos-table">
        <thead>
            <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
           
            <th colspan="3">Acciones
                   <!-- <a  class="glyphicon  plus btn-sm glyphicon-plus"  href="{!! route('users.create') !!}"></a>-->
         </th>
            </tr>
        </thead>
        <tbody class='buscar'>
        @foreach ($data as $key => $user)
            <tr>
                <td>{!! $user->name !!}</td>
                <td>{!! $user->email !!}</td>
                <td> @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                        <label class="badge badge-success">{{ $v }}</label>
                        @endforeach
                    @endif
                </td>
                
                <td>
                    {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('users.show', [$user->id]) !!}" class='btn btn-success btn-sm'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-info btn-sm'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


     </div>
