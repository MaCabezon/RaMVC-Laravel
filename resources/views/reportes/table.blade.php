<div id ="encabezado" class="col-lg-12" class="label label-default" >
         <h3>Reporte</h3>
         <hr/>
</div>

    <div class="container" >
        <div class="row"></div>
          <div>
            <table class="table table-responsive" id="resumenAlumnos-table">
                <thead>
                    <tr>
                        <th>Alumno</th>
                        <th>Evento</th>                        
                        <th>Horas</th>
                        <th>Porcentaje</th>
                        
                        
                    </tr>
                </thead>
                <tbody class='buscar'>
                @foreach($data as $dat)
                    <tr>
                        <td>{!! $dat['alumno'] !!}</td>
                        <td>{!! $dat['evento'] !!}</td>                       
                        <td>{!! $dat['horas'] !!}</td>
                        <td>{!! $dat['porcentaje'] !!}</td>                  
                        
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

     </div>
