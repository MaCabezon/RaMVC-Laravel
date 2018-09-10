

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
            <th colspan="3">Acciones
                @can('eventos-create')
                      <a  class="glyphicon  plus btn-sm glyphicon-plus"  href="{!! route('eventos.create') !!}"></a>
                @endcan
            </th>

            </tr>
        </thead>
        <tbody class='buscar'>
        
        @foreach($eventos as $evento)
            <tr>
                <td>{!! $evento->abreviatura !!}</td>
                <td>{!! $evento->nombre !!}</td>
                <td>{!! $evento->grupo !!}</td>
                <td>{!! $evento->nombreProfesor !!}</td>
                <td>
                    {!! Form::open(['route' => ['eventos.destroy', $evento->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                    @can('eventos-show')
                        <a href="{!! route('eventos.show', [$evento->id]) !!}" class='btn btn-success btn-sm'><i class="glyphicon glyphicon-eye-open"></i></a>
                    @endcan
                    @can('eventos-edit')
                        <a href="{!! route('eventos.edit', [$evento->id]) !!}" class='btn btn-info btn-sm'><i class="glyphicon glyphicon-edit"></i></a>
                    @endcan
                    @can('eventos-delete')
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    @endcan
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class='text-center'>
        {!!  $eventos->render() !!}
           <p>Página {{$eventos->currentPage()}} de {{$eventos->lastPage()}}</p>
 </div>
