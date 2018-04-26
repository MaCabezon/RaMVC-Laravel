<div id ="encabezado" class="col-lg-12" class="label label-default" >
         <h3>Uneatlantico Asistencias</h3>
         <hr/>
</div>

    <div class="container" >
        <div class="row">

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
              <div class="row" style="width: 100%; float:left;">
            @endif

            <!-- Si falla poner a 45% -->
              <table class="table" style="width: 50%; float: left;">

                  <thead class="thead-dark">
                      <tr>
                         <th colspan="5" scope="col">{!! $vista[$key]->Evento !!}</th>
                       </tr>
                  </thead>
                  <tbody>
                @php
                $eventoAct = $vista[$key]->Evento
                @endphp
              @endif

                   <tr>

                     @for($i=0; $i < 5; $i++)
                      @if(isset($vista[$key+$i]) && $vista[$key+$i]->Evento==$eventoAct)
                     <td id="{{$vista[$key+$i]->Alumno}}{{$vista[$key+$i]->Evento}}">
                       @if($vista[$key+$i]->Estado=='activado')
                        <img src="{{ asset('css/images/IconoV.png') }}" height="42" width="42"/>
                       @elseif($vista[$key+$i]->Estado=='desactivado')
                        <img src="{{ asset('css/images/IconoR.png') }}" height="42" width="42"/>
                       @elseif($vista[$key+$i]->Estado=='pendiente')
                        <img src="{{ asset('css/images/IconoA.png') }}" height="42" width="42"/>
                       @endif
                        </br>
                       {!!$vista[$key+$i]->Alumno !!}
                     </br>

                     @if ($vista[$key+$i]->Horas)
                     {!!$vista[$key+$i]->Horas !!}
                     @else
                     {!!SIN HORAS!!}
                     @endif
                      </br>

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
</div>

     </div>
