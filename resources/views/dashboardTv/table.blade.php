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
            @if($table==7)
              <div class="row" style="width: 100%; float:left;">
            @endif

            <!-- Si falla poner a 45% -->
              <table class="table" style="width: 18%; float: left; border: none;">

                  <thead class="thead-dark">
                      <tr>
                        @if($table%2!=0)
                           <th colspan="5" scope="col" style="border: none; background-color: #76C9FF !important;">{!! $vista[$key]->Evento !!}</th>
                           @else
                             <th colspan="5" scope="col" style="border: none; background-color: #2EADFF !important;">{!! $vista[$key]->Evento !!}</th>
                          @endif

                       </tr>
                  </thead>
                  <tbody class="buscar">
                @php
                $eventoAct = $vista[$key]->Evento
                @endphp
              @endif

                  @if($table%2!=0)
                   <tr style="background-color: #76C9FF;">
                     @else
                     <tr style="background-color: #2EADFF;">
                    @endif

                     @for($i=0; $i < 5; $i++)
                      @if(isset($vista[$key+$i]) && $vista[$key+$i]->Evento==$eventoAct)
                     <td id="{{$vista[$key+$i]->Alumno}}{{$vista[$key+$i]->Evento}}" style="float: left; border: none;">
                       @if($vista[$key+$i]->Estado=='activado')
                        <img src="{{ asset('css/images/IconoV.png') }}" height="25" width="25"/>
                       @elseif($vista[$key+$i]->Estado=='desactivado')
                        <img src="{{ asset('css/images/IconoR.png') }}" height="25" width="25"/>
                       @elseif (substr( $vista[$key+$i]->Estado, 0, 1 ) === "P")
                        <img src="{{ asset('css/images/IconoA.png') }}" height="25" width="25"/>
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
</div>

     </div>
