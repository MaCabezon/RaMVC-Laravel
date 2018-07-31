<li class="{{ Request::is('eventos*') ? 'active' : '' }}">
    <a href="{!! route('eventos.index') !!}"><i class="fa fa-edit"></i><span>Eventos</span></a>
</li>

<li class="{{ Request::is('transacciones*') ? 'active' : '' }}">
    <a href="{!! route('transacciones.index') !!}"><i class="fa fa-edit"></i><span>Transacciones</span></a>
</li>

<li class="{{ Request::is('resumenAlumnos*') ? 'active' : '' }}">
    <a href="{!! route('resumenAlumnos.index') !!}"><i class="fa fa-edit"></i><span>Resumen Alumnos</span></a>
</li>

<li class="{{ Request::is('resumenEventos*') ? 'active' : '' }}">
    <a href="{!! route('resumenEventos.index') !!}"><i class="fa fa-edit"></i><span>Resumen Eventos</span></a>
</li>



<li class="{{ Request::is('valoracionBecarios*') ? 'active' : '' }}">
    <a href="{!! route('valoracionBecarios.index') !!}"><i class="fa fa-edit"></i><span>Valoracion Becarios</span></a>
</li>

