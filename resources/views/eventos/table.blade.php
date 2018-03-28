<div id ="encabezado" class="col-lg-12" class="label label-default" >
         <h3>Listado de Eventos</h3>
         <hr/>
</div>
      
    <div class="container" >
        <div class="row"></div>
          <div>
    <table class="table table-responsive" id="eventos-table">
        <thead>
            <tr>
                <th>Abreviatura</th>
            <th>Nombre</th>
            <th>Grupo</th>
            <th>Profesor</th>
                <th colspan="3">Action
                    <a  class="glyphicon  plus btn-sm glyphicon-plus"  href="{!! route('eventos.create') !!}"></a>
                </th>
            </tr>
        </thead>
        <tbody class='buscar'>
        @foreach($eventos as $eventos)
            <tr>
                <td>{!! $eventos->abreviatura !!}</td>
                <td>{!! $eventos->nombre !!}</td>
                <td>{!! $eventos->grupo !!}</td>
                <td>{!! $eventos->nombreProfesor !!}</td>
                <td>
                    {!! Form::open(['route' => ['eventos.destroy', $eventos->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('eventos.show', [$eventos->id]) !!}" class='btn btn-success btn-sm'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('eventos.edit', [$eventos->id]) !!}" class='btn btn-info btn-sm'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
           

     </div>

