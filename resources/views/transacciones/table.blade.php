<div id ="encabezado" class="col-lg-12" class="label label-default" >
         <h3>Listado de Transacciones</h3>
         <hr/>
</div>

    <div class="container" >
        <div class="row"></div>
          <div>
    <table class="table table-responsive" id="eventos-table">
        <thead>
            <tr>
            <th>Persona</th>
            <th>Id Evento</th>
            <th>Fecha</th>
            <th>Tipo</th>
            <th>Validado</th>
                <th colspan="3">Acciones
                    <a  class="glyphicon  plus btn-sm glyphicon-plus"  href="{!! route('transacciones.create') !!}"></a>
                </th>
            </tr>
        </thead>
        <tbody class='buscar'>
        @foreach($transacciones as $transacciones)
            <tr>
                <td>{!! $transacciones->idPersona !!}</td>
                <td>{!! $transacciones->idEvento !!}</td>
                <td>{!! $transacciones->fechaEvento !!}</td>
                <td>{!! $transacciones->tipo !!}</td>
                <td>{!! $transacciones->validado !!}</td>
                <td>
                    {!! Form::open(['route' => ['transacciones.destroy', $transacciones->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('transacciones.show', [$transacciones->id]) !!}" class='btn btn-success btn-sm'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('transacciones.edit', [$transacciones->id]) !!}" class='btn btn-info btn-sm'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


     </div>
