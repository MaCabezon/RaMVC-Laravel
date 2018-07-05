
<div id ="encabezado" class="col-lg-12" class="label label-default" >
</div>

    <div class="container" >
        <div class="row"></div>
    <div>
    <table class="table table-responsive" id="resumenEventos-table">
        <thead>
            <tr>
                <th>Evento</th>
                <th>Fecha evento</th>
                <th>Horas</th>
                <th colspan="3">Acciones
                @can('resumenEventos-create')
                    <a  class="glyphicon  plus btn-sm glyphicon-plus"  href="{!! route('resumenEventos.create') !!}"></a>
                @endcan
                </th>
            </tr>
        </thead>
        <tbody class='buscar'>
        @foreach($resumenEventos as $resumenEventos)
            <tr>
                <td>{!! $resumenEventos->nombre !!}</td>
                <td>{!! $resumenEventos->fechaEvento !!}</td>
                <td>{!! $resumenEventos->horas !!}</td>
                <td>
                    {!! Form::open(['route' => ['resumenEventos.destroy', $resumenEventos->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                    @can('resumenEventos-show')
                        <a href="{!! route('resumenEventos.show', [$resumenEventos->id]) !!}" class='btn btn-success btn-sm'><i class="glyphicon glyphicon-eye-open"></i></a>
                    @endcan
                    @can('resumenEventos-show')
                        <a href="{!! route('resumenEventos.edit', [$resumenEventos->id]) !!}" class='btn btn-info btn-sm'><i class="glyphicon glyphicon-edit"></i></a>
                    @endcan
                    @can('resumenEventos-delete')
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

</div>
