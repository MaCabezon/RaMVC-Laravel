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
            @if($table==6)
              <div  class="col-lg-12" id="contenedor_materia">
            @endif

              <table class="col-lg-2" id="tabla_asistencia" style="border:inset 0pt; float: left; background-color: #0087FF !important">

                  <thead class="thead-dark">
                      <tr>
                         <th colspan="6" scope="col" style="border:inset 0pt;">{!! $vista[$key]->Evento !!}</th>
                       </tr>
                  </thead>
                  <tbody class="buscar" style="background-color: #0087FF !important;">
                @php
                $eventoAct = $vista[$key]->Evento
                @endphp
              @endif

                   <tr>
                     <!--Color azul == #0087FF -->
                     @for($i=0; $i < 6; $i++)
                      @if(isset($vista[$key+$i]) && $vista[$key+$i]->Evento==$eventoAct)
                     <td id="{{$vista[$key+$i]->Alumno}}{{$vista[$key+$i]->Evento}}" style="border:inset 0pt;">
                       @if($vista[$key+$i]->Estado=='activado')
                        <div class="verde col-lg-2"></div>
                       @elseif($vista[$key+$i]->Estado=='desactivado')
                        <div class="rojo col-lg-2"></div>
                       @elseif (substr( $vista[$key+$i]->Estado, 0, 1 ) === "P")
                        <div class="amarillo col-lg-2"></div>
                       @endif
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
