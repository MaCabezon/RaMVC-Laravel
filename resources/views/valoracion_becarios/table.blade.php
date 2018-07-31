
<table class="table table-responsive" id="valoracionBecarios-table">
<thead>
    <tr>
        <th>Trabajo de Colaboración</th>
        <th colspan="5">Observaciones</th>

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
    <tbody>
    @foreach($valoracionBecarios as $valoracionBecarios)
    <label>Alumno: {!! $valoracionBecarios->idAlumno !!}</label><br/>
    <label>Curso: {!! $valoracionBecarios->curso !!}</label>
        <tr>
            <td><strong>Parametro a evaluar</strong></td>
            <td><strong>1</strong></td>
            <td><strong>2</strong></td>
            <td><strong>3</strong></td>
            <td><strong>4</strong></td>
            <td><strong>5</strong></td>
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
            @if ($valoracionBecarios->$cualId == ($id + 1) )
              {!! Form::checkbox($cualidadesId[$id], '1', true, array('disabled')) !!}
            @else
              {!! Form::checkbox($cualidadesId[$id], '1', false, array('disabled')) !!}
            @endif

            </td>
          @endfor
          </tr>
        @endfor
        
            <td>Cumplimiento de Horas</td>
            <td colspan="5">{!! $valoracionBecarios->cumplimientoHoras !!}</td>

        </tr>
        <tr>

            <td>Materias</td>
            <td colspan="5">{!! $valoracionBecarios->cumplimientoHoras !!}</td>

        </tr>
        <!--<tr>

            <td>{!! $valoracionBecarios->annio !!}</td>
            <td>
                {!! Form::open(['route' => ['valoracionBecarios.destroy', $valoracionBecarios->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('valoracionBecarios.show', [$valoracionBecarios->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('valoracionBecarios.edit', [$valoracionBecarios->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>-->
    @endforeach
    </tbody>
</table>
