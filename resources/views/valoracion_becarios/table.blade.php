
<table class="table table-responsive" id="valoracionBecarios-table">
<thead>
    <tr>
        <th>Trabajo de Colaboración</th>
        <th colspan="5">Observaciones</th>
        <th colspan="3">Acciones
        <a  class="glyphicon  plus btn-sm glyphicon-plus"  href="{!! route('valoracionBecarios.create') !!}"></a>
        </th>

    </tr>
</thead>
    <!--<thead>
        <tr>
            <th>Idalumno</th>
        <th>Curso</th>
        <th>Formatrabajo</th>
        <th>Actitud</th>
        <th>Manejotecnologia</th>
        <th>Adaptacion</th>
        <th>Responsabilidad</th>
        <th>Cumplimientohoras</th>
        <th>Materias</th>
        <th>Annio</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>-->
    <tbody class='buscar'>
    @foreach($valoracionBecarios as $valoracionBecario)
    <label>Alumno: {!! $valoracionBecario->idAlumno !!}</label><br/>
    <label>Curso: {!! $valoracionBecario->curso !!}</label>
        <tr>
            <td><strong>Parametro a evaluar</strong></td>
            <td><strong>1</strong></td>
            <td><strong>2</strong></td>
            <td><strong>3</strong></td>
            <td><strong>4</strong></td>
            <td><strong>5</strong></td>
            <td>
                    {!! Form::open(['route' => ['valoracionBecarios.destroy', $valoracionBecario->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                    @can('valoracionesBecarios-show')
                        <a href="{!! route('valoracionBecarios.show', [$valoracionBecario->id]) !!}" class='btn btn-success btn-sm'><i class="glyphicon glyphicon-eye-open"></i></a>
                    @endcan
                    @can('valoracionesBecarios-edit')
                        <a href="{!! route('valoracionBecarios.edit', [$valoracionBecario->id]) !!}" class='btn btn-info btn-sm'><i class="glyphicon glyphicon-edit"></i></a>
                    @endcan
                    @can('valoracionesBecarios-delete')
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    @endcan
                    </div>
                    {!! Form::close() !!}
                </td>
        </tr>

        @php
          $cualidades = array ("Forma de Trabajo", "Actitud", "Manejo de la Tecnologia", "Adaptación", "Responsabilidad");
          $cualidadesId = array ("formaTrabajo", "actitud", "manejoTecnologia", "adaptacion", "responsabilidad");
        @endphp


        @for ($i = 0; $i < 5; $i++)
          <tr>
            <td>{!! $cualidades[$i] !!}</td>
          @for ($id = 0; $id < 5; $id++)
            <td>
              @php
                $cualId = $cualidadesId[$i];
              @endphp

              {!! Form::hidden($cualidadesId[$id], $cualidadesId[$id], false) !!}
            @if ($valoracionBecario->$cualId == ($id + 1) )
              {!! Form::checkbox($cualidadesId[$id], '1', true, array('disabled')) !!}
            @else
              {!! Form::checkbox($cualidadesId[$id], '1', false, array('disabled')) !!}
            @endif

            </td>
          @endfor
          </tr>
        @endfor
        
            <td>Cumplimiento de Horas</td>
            <td colspan="5">{!! $valoracionBecario->cumplimientoHoras !!}</td>

        </tr>
        <tr>

            <td>Materias</td>
            <td colspan="5">{!! $valoracionBecario->materias !!}</td>

        </tr>
        <tr>
            <td>Curso</td>
            <td colspan="5">{!! $valoracionBecario->annio !!}</td>
        </tr>
        
    @endforeach
    </tbody>
</table>

<div class='text-center'>
        {!!  $valoracionBecarios->render() !!}
           <p>Página {{$valoracionBecarios->currentPage()}} de {{$valoracionBecarios->lastPage()}}</p>
 </div>
        