
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
        <tr>
            <td><strong>Parametro a evaluar</strong></td>
            <td><strong>1</strong></td>
            <td><strong>2</strong></td>
            <td><strong>3</strong></td>
            <td><strong>4</strong></td>
            <td><strong>5</strong></td>
        </tr>
        <tr>
            <td>Forma de Trabajo</td>
            <td>{!! Form::checkbox('validado', '1', null) !!}</td>
            <td>{!! Form::checkbox('validado', '1', null) !!}</td>
            <td>{!! Form::checkbox('validado', '1', null) !!}</td>
            <td>{!! Form::checkbox('validado', '1', null) !!}</td>
            <td>{!! Form::checkbox('validado', '1', null) !!}</td>
        </tr>
       
        <tr>
            <td>Actitud</td>
            <td>{!! Form::checkbox('validado', '1', null) !!}</td>
            <td>{!! Form::checkbox('validado', '1', null) !!}</td>
            <td>{!! Form::checkbox('validado', '1', null) !!}</td>
            <td>{!! Form::checkbox('validado', '1', null) !!}</td>
            <td>{!! Form::checkbox('validado', '1', null) !!}</td>
        </tr>   
        <tr>

            <td>Manejo de la Tecnoliga</td>
            <td>{!! Form::checkbox('validado', '1', null) !!}</td>
            <td>{!! Form::checkbox('validado', '1', null) !!}</td>
            <td>{!! Form::checkbox('validado', '1', null) !!}</td>
            <td>{!! Form::checkbox('validado', '1', null) !!}</td>
            <td>{!! Form::checkbox('validado', '1', null) !!}</td>
        </tr> 
        <tr>

            <td>Adaptación</td>
            <td>{!! Form::checkbox('validado', '1', null) !!}</td>
            <td>{!! Form::checkbox('validado', '1', null) !!}</td>
            <td>{!! Form::checkbox('validado', '1', null) !!}</td>
            <td>{!! Form::checkbox('validado', '1', null) !!}</td>
            <td>{!! Form::checkbox('validado', '1', null) !!}</td>
        </tr>  
        <tr>

            <td>Responsabilidad</td>
            <td>{!! Form::checkbox('validado', '1', null) !!}</td>
            <td>{!! Form::checkbox('validado', '1', null) !!}</td>
            <td>{!! Form::checkbox('validado', '1', null) !!}</td>
            <td>{!! Form::checkbox('validado', '1', null) !!}</td>
            <td>{!! Form::checkbox('validado', '1', null) !!}</td>
        </tr>
        <tr>

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