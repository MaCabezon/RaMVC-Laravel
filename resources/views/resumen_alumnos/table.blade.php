<div id ="encabezado" class="col-lg-12" class="label label-default" >
         <h3>Resumen de Alumnos</h3>
         <hr/>
</div>
      
    <div class="container" >
        <div class="row"></div>
          <div> 
            <table class="table table-responsive" id="resumenAlumnos-table">
                <thead>
                    <tr>
                        <th>Persona</th>
                        <th>Idevento</th>
                        <th>Fechaevento</th>
                        <th>Horas</th>
                        <th colspan="3">Action 
                            <a  class="glyphicon  plus btn-sm glyphicon-plus"  href="{!! route('resumenAlumnos.create') !!}"></a>
        
                        </th>
                    </tr>
                </thead>
                <tbody class='buscar'>
                @foreach($resumenAlumnos as $resumenAlumnos)
                    <tr>
                        <td>{!! $resumenAlumnos->idAlumno !!}</td>
                        <td>{!! $resumenAlumnos->idEvento !!}</td>
                        <td>{!! $resumenAlumnos->fechaEvento !!}</td>
                        <td>{!! $resumenAlumnos->horas !!}</td>
                        <td>
                            {!! Form::open(['route' => ['resumenAlumnos.destroy', $resumenAlumnos->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                <a href="{!! route('resumenAlumnos.show', [$resumenAlumnos->id]) !!}" class='btn btn-success btn-sm'><i class="glyphicon glyphicon-eye-open"></i></a>
                                <a href="{!! route('resumenAlumnos.edit', [$resumenAlumnos->id]) !!}" class='btn btn-info btn-sm'><i class="glyphicon glyphicon-edit"></i></a>
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