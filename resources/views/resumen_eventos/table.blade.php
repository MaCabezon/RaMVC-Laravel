<div id ="encabezado" class="col-lg-12" class="label label-default" >
         <h3>Resumen de Eventos</h3>
         <hr/>
</div>
      
    <div class="container" >
        <div class="row"></div>
    <div> 
    <table class="table table-responsive" id="resumenEventos-table">
        <thead>
            <tr>
                <th>Idevento</th>
                <th>Fechaevento</th>
                <th>Horas</th>
                <th colspan="3">Action
                    <a  class="glyphicon  plus btn-sm glyphicon-plus"  href="{!! route('resumenEventos.create') !!}"></a>
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach($resumenEventos as $resumenEventos)
            <tr>
                <td>{!! $resumenEventos->idEvento !!}</td>
                <td>{!! $resumenEventos->fechaEvento !!}</td>
                <td>{!! $resumenEventos->horas !!}</td>
                <td>
                    {!! Form::open(['route' => ['resumenEventos.destroy', $resumenEventos->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('resumenEventos.show', [$resumenEventos->id]) !!}" class='btn btn-success btn-sm'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('resumenEventos.edit', [$resumenEventos->id]) !!}" class='btn btn-info btn-sm'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>        

</div>