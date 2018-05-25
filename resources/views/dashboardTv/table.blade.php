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
              $flagtable = true;
            @endphp

            <?php $table++; ?>
            @if($table==7)
              <div  class="col-lg-12" id="contenedor_materiaTv">
            @endif

              <table class="col-lg-2" id="tabla_asistenciaTv" style="width:15%;margin-top: 0.5%;margin-bottom: 1%">
                 <thead class="thead-dark" >
                      <tr>
                         <th colspan="7" scope="col" style="background-color: white; font-size: 150%">{!! $vista[$key]->Evento !!}</th>
                       </tr>
                  </thead>
                  <tbody class="buscar">
                @php
                $eventoAct = $vista[$key]->Evento
                @endphp
              @endif

                   <tr>

                  
                     <!--Color azul == #0087FF -->
                     @for($i=0; $i < 7; $i++)
                      @if(isset($vista[$key+$i]) && $vista[$key+$i]->Evento==$eventoAct)
                    
                     <td id="{{$vista[$key+$i]->Alumno}}{{$vista[$key+$i]->Evento}}" style="border:inset 0pt;">
                       @if($vista[$key+$i]->Estado=='activado')
                        <div class="verde_tv col-lg-2"></div>
                       @elseif($vista[$key+$i]->Estado=='desactivado')
                        <div class="rojo_tv col-lg-2"></div>
                       @elseif (substr( $vista[$key+$i]->Estado, 0, 1 ) === "P")
                        <div class="amarillo_tv col-lg-2"></div>
                       @endif
                    </td>

                    @else
                      <?php break; ?>
                    @endif

                    @endfor
                    <?php $key = $key + $i-1; ?>
                  </div>


    @endfor
  </tbody>


</table>
 