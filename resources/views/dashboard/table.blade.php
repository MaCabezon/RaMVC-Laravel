<div id ="encabezado" class="col-lg-12" class="label label-default" >
         <h3>Uneatlantico Asistencias</h3>
         <hr/>
</div>

        <!-- Variable que guarda el evento -->
        @php
          $eventoAct ="";
          $flagTable = false;
        @endphp

        <?php $key=0; ?>
        <?php $break=false; ?>
        <?php $keyAux=0; ?>
        <?php $i=0; ?>
        <?php $table=0; ?>

        @for ($key = 0; $key < count($vista); $key++)

            @if($vista[$key]->Evento!=$eventoAct)
            @if($flagTable)
                    </tbody>


            </table>
            @if($table%2==0)
            </div>
            @endif
            @endif

            @php
              $flagTable = true;
            @endphp

            <?php $table++; ?>
            @if($table%2!=0)
              <div  class="col-lg-12" id="contenedor_materia" >
            @endif

              <table class="col-lg-6 offset-lg-2" id="tabla_asistencia" >

                  <thead class="thead-dark">
                      <tr>
                         <th colspan="5" scope="col">{!! $vista[$key]->Evento !!}</th>
                       </tr>
                  </thead>
                  <tbody class="buscar">
                @php
                $eventoAct = $vista[$key]->Evento
                @endphp
              @endif

                   <tr>

                     @for($i=0; $i < 4; $i++)
                      @if(isset($vista[$key+$i]) && $vista[$key+$i]->Evento==$eventoAct)
                     <td id="{{$vista[$key+$i]->Alumno}}{{$vista[$key+$i]->Evento}}" style="float: left; border:inset 0pt;">
                       @if($vista[$key+$i]->Estado=='activado')
                        <img src="{{ asset('css/images/IconoV.png') }}" height="30px" width="30px"/>
                       @elseif($vista[$key+$i]->Estado=='desactivado')
                        <img src="{{ asset('css/images/IconoR.png') }}" height="30px" width="30px"/>
                       @elseif (substr( $vista[$key+$i]->Estado, 0, 1 ) === "P")
                        <img src="{{ asset('css/images/IconoA.png') }}" height="30px" width="30px"/>
                       @endif
                       <div style="float: right;">
                       {!!$vista[$key+$i]->Alumno !!}
                       </br>
                       {!!$vista[$key+$i]->Horas !!}
                       </div>
                        </br>
                        {!!$vista[$key+$i]->Estado !!}
                    </td>

                    @else
                      <?php break; ?>
                    @endif

                    @endfor
                    <?php $key = $key + $i-1; ?>
                  </tr>


    @endfor
  </tbody>


</table>
