<div id ="encabezado" class="col-lg-12" class="label label-default" >
         <h3>Listado de Permisos</h3>
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
            @can('permissions-create')
                    <a  class="glyphicon  plus btn-sm glyphicon-plus"  href="{!! route('permissions.create') !!}"></a>
            @endcan
         </th>
            </tr>
        </thead>
        <tbody class='buscar'>
        @foreach ($permissions as $permission)
            <tr>
                <td>{!! $permission->name !!}</td>               
                
                <td>
                    {!! Form::open(['route' => ['permissions.destroy', $permission->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                    @can('permissions-show')
                        <a href="{!! route('permissions.show', [$permission->id]) !!}" class='btn btn-success btn-sm'><i class="glyphicon glyphicon-eye-open"></i></a>
                    @endcan
                    @can('permissions-edit')
                        <a href="{!! route('permissions.edit', [$permission->id]) !!}" class='btn btn-info btn-sm'><i class="glyphicon glyphicon-edit"></i></a>
                    @endcan
                    @can('permissions-delete')
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
