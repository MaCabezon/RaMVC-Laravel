<table class="table table-responsive" id="transacciones-table">
    <thead>
        <tr>
            <th>Persona</th>
        <th>Idevento</th>
        <th>Fechaevento</th>
        <th>Fecharegistro</th>
        <th>Tipo</th>
        <th>Validado</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
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