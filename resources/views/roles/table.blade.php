<div id ="encabezado" class="col-lg-12" class="label label-default" >
         <h3>Listado de Roles</h3>
         <hr/>
</div>

    <div class="container" >
        <div class="row"></div>
          <div>
    <table class="table table-responsive" id="eventos-table">
        <thead>
            <tr>
            <th>Nombre</th> 
            <th colspan="3">Acciones
            @can('role-create')
                    <a  class="glyphicon  plus btn-sm glyphicon-plus"  href="{!! route('roles.create') !!}"></a>
            @endcan
         </th>
            </tr>
        </thead>
        <tbody class='buscar'>
        @foreach ($roles as $key => $role)
            <tr>
                <td>{!! $role->name !!}</td>               
                
                <td>
                    {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                    
                     @can('role-edit')
                        <a href="{!! route('roles.edit', [$role->id]) !!}" class='btn btn-info btn-sm'><i class="glyphicon glyphicon-edit"></i></a>
                     @endcan
                     @can('role-delete')
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    @endcan
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


     </div>
