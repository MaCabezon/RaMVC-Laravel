
<div id ="encabezado" class="col-lg-12" class="label label-default" >
</div>
<div class="container" >
    <div class="row"></div>
      <div>
        <table class="table table-responsive" id="resumenAlumnos-table">
            <thead>
                <tr>
                    <th>Persona</th>
                    <th>Evento</th>
                    <th>Fecha evento</th>
                    <th>Horas</th>
                    <th>Validado</th>
                    <th>Justificante</th>
                    <th colspan="3">Acciones
                            @can('resumenAlumnos-create')
                                <a  class="glyphicon  plus btn-sm glyphicon-plus"  href="{!! route('resumenAlumnos.create') !!}"></a>
                                @endcan
                        </th>

                    </tr>
                </thead>
                <tbody class='buscar'>
                @foreach($resumenAlumnos as $resumenAlumnos)
                    <tr>
                        <td>{!! $resumenAlumnos->idAlumno !!}</td>
                        <td>{!! $resumenAlumnos->nombre !!}</td>
                        <td>{!! $resumenAlumnos->fechaEvento !!}</td>
                        <td>{!! $resumenAlumnos->horas !!}</td>
                        <td>{!! $resumenAlumnos->validado !!}</td>
                        @if ($resumenAlumnos->justificante=="")
                          <td>{!! $resumenAlumnos->justificante !!}</td>
                        @else 
                          <td> vacio</td>
                        @endif
                        
                        <td>
                            {!! Form::open(['route' => ['resumenAlumnos.destroy', $resumenAlumnos->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                            @can('resumenAlumnos-show')
                                <a href="{!! route('resumenAlumnos.show', [$resumenAlumnos->id]) !!}" class='btn btn-success btn-sm'><i class="glyphicon glyphicon-eye-open"></i></a>
                            @endcan
                            @can('resumenAlumnos-edit')
                                <a href="{!! route('resumenAlumnos.edit', [$resumenAlumnos->id]) !!}" class='btn btn-info btn-sm'><i class="glyphicon glyphicon-edit"></i></a>
                            @endcan
                            @can('resumenAlumnos-delete')
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
