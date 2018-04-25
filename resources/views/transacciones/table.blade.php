<table class="table table-responsive" id="transacciones-table">
    <thead>
        <tr>
            <th>Persona</th>
        <th>Id evento</th>
        <th>Fecha evento</th>
        <th>Fecha registro</th>
        <th>Tipo</th>
        <th>Validado</th>
            <th colspan="3">Acciones</th>
        </tr>
    </thead>
    <tbody class='buscar'>
    @foreach($transacciones as $transacciones)
        <tr>
            <td>{!! $transacciones->persona !!}</td>
            <td>{!! $transacciones->idEvento !!}</td>
            <td>{!! $transacciones->fechaEvento !!}</td>
            <td>{!! $transacciones->fechaRegistro !!}</td>
            <td>{!! $transacciones->tipo !!}</td>
            <td>{!! $transacciones->validado !!}</td>
            <td>
                {!! Form::open(['route' => ['transacciones.destroy', $transacciones->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('transacciones.show', [$transacciones->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('transacciones.edit', [$transacciones->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
