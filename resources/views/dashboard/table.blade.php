  <div id ="encabezado" class="col-lg-12" class="label label-default" >
   <h3>Uneatlantico Asistencias</h3>
   <hr/>
  </div>

  <div class="col-lg-12" id="contenedor_dashboard" >
    <div class="col-md-12">

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



          @if($table%2==0)
            </div>
       @endif
      @endif

     @php
      $flagTable = true;
     @endphp

  <?php $table++; ?>
  @if($table%2!=0)

  <div class="col-md-6 " id="contenedor_materia" >
    @endif

     <!-- Si falla poner a 45% -->
    <table class="table" id="tabla_asistencia" style=" float: left;">

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

         @for($i=0; $i < 5; $i++)
         @if(isset($vista[$key+$i]) && $vista[$key+$i]->Evento==$eventoAct)
        <td class= "col-lg-2" id="{{$vista[$key+$i]->Alumno}}{{$vista[$key+$i]->Evento}}" style="float: left; border: inset 0pt">
          <div id="nombre"> {!!$vista[$key+$i]->Alumno !!} </div>
          @if($vista[$key+$i]->Estado=='activado')
          <img src="{{ asset('css/images/IconoV.png') }}" height="30%" width="30%"/>
          @elseif($vista[$key+$i]->Estado=='desactivado')
          <img src="{{ asset('css/images/IconoR.png') }}" height="30%" width="30%"/>
          @elseif (substr( $vista[$key+$i]->Estado, 0, 1 ) === "P")
          <img src="{{ asset('css/images/IconoA.png') }}" height="30%" width="30%"/>
          @endif

          <div style="float: right;">
            {!!$vista[$key+$i]->Estado !!}
            </br>
            {!!$vista[$key+$i]->Horas !!}
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
  </div>

  </div>
