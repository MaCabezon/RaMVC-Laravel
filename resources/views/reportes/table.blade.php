<div id ="encabezado" class="col-lg-12" class="label label-default" >
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
                        <td>

                             <div class="col-md-12">
                              <div class="col-md-12">
                                <div class="progress">
                                  <div data-percentage="0%" style="width: {!! $dat['porcentaje'] !!}; color: black;" class="progress-bar progress-bar-info" role="progressbar" aria-valuemin="0" aria-valuemax="100">{!! $dat['porcentaje'] !!}</div>
                                </div>
                              </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

     </div>
