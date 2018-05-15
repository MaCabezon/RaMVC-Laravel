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

              <table class="col-lg-6 offset-lg-2" id="tabla_asistencia"  style="width:45%;margin-top: 0.5%;margin-bottom: 1%">

                  <thead class="thead-dark" >
                      <tr>
                         <th colspan="5" scope="col" style="background-color: white">{!! $vista[$key]->Evento !!}</th>
                       </tr>
                  </thead>
                  <tbody class="buscar">
                @php
                $eventoAct = $vista[$key]->Evento
                @endphp
              @endif

                   <tr>

                     @for($i=0; $i < 5; $i++)
                      @if(isset($vista[$key+$i]) && $vista[$key+$i]->Evento==$eventoAct)

                     <td class="col-lg-2" id="{{$vista[$key+$i]->Alumno}}{{$vista[$key+$i]->Evento}}" style=" width:20% ;float: left;margin-top: 1%; padding-left: 0%; padding-right: 0%; border:inset 0pt;">
                          
                        <div id="alumno_">

                           <div id="nombre" style="text-align: right;">
                           {!!$vista[$key+$i]->Alumno !!}
                           </div>
                           @if($vista[$key+$i]->Estado=='activado')
                            <div class="verde col-lg-2"></div>
                           @elseif($vista[$key+$i]->Estado=='desactivado')
                             <div class="rojo col-lg-2"></div>
                           @elseif (substr( $vista[$key+$i]->Estado, 0, 1 ) === "P")
                            <div class="amarillo col-lg-2"></div>
                           @endif
                           <div style="float: left; padding-left: 2%">
                            {!!$vista[$key+$i]->Estado !!}
                              </br>
                            {!!$vista[$key+$i]->Horas !!}
                            </div>
                        </div>
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