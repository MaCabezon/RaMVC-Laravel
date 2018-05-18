<<<<<<< HEAD
<div id ="encabezado" class="col-lg-12" class="label label-default" >
=======
  <div id ="encabezado" class="col-lg-12" class="label label-default" >
>>>>>>> a3518e1c44b7a46ea18cce6da6d87215f80936f5
         <h3>Uneatlantico Asistencias</h3>
         <hr/>
</div>

<<<<<<< HEAD
    <div class="container" >
        <div class="row">

=======
>>>>>>> a3518e1c44b7a46ea18cce6da6d87215f80936f5
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
<<<<<<< HEAD
              $flagTable = true;
=======
              $flagtable = true;
>>>>>>> a3518e1c44b7a46ea18cce6da6d87215f80936f5
            @endphp

            <?php $table++; ?>
            @if($table==7)
<<<<<<< HEAD
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

=======
              <div  class="col-lg-12" id="contenedor_materiaTv">
            @endif

              <table class="col-lg-2" id="tabla_asistenciaTv" style="width:15%;margin-top: 0.5%;margin-bottom: 1%">
                 <thead class="thead-dark" >
                      <tr>
                         <th colspan="7" scope="col" style="background-color: white; font-size: 150%">{!! $vista[$key]->Evento !!}</th>
>>>>>>> a3518e1c44b7a46ea18cce6da6d87215f80936f5
                       </tr>
                  </thead>
                  <tbody class="buscar">
                @php
                $eventoAct = $vista[$key]->Evento
                @endphp
              @endif

<<<<<<< HEAD
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
=======
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
>>>>>>> a3518e1c44b7a46ea18cce6da6d87215f80936f5
                       @endif
                    </td>

                    @else
                      <?php break; ?>
                    @endif

                    @endfor
                    <?php $key = $key + $i-1; ?>
<<<<<<< HEAD
                  </tr>
=======
                  </div>
>>>>>>> a3518e1c44b7a46ea18cce6da6d87215f80936f5


    @endfor
  </tbody>


</table>
<<<<<<< HEAD
</div>

     </div>
=======
 
>>>>>>> a3518e1c44b7a46ea18cce6da6d87215f80936f5
