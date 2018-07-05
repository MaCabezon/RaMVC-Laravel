
@extends('layouts.app')
@section('content')

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix">
          <div id ="encabezado" class="col-lg-12" class="label label-default" >
                   <h3>Listado de Eventos</h3>
                   <hr/>
          </div>
          <div class="container">
	           <div class="row">
		             <div class="col-md-12">
		                 <form class="form-inline form-filtro">
                       <div class="form-group">
                         <label class="sr-only" for="filtro-data-inicial">Data inicial</label>
                         <input type="date" class="form-control" id="filtro-data-inicial">
                       </div>
                       <div class="form-group">
                         <label class="sr-only" for="filtro-data-final">Data final</label>
                         <input type="date" class="form-control" id="filtro-data-final">
                       </div>
                       <div class="form-group">
                         <label class="sr-only" for="filtro-tipo">Tipo</label>
                         <select class="form-control" id="filtro-tipo">
                           <option value="">Tipo</option>
                           <option value="">Receita</option>
                           <option value="">Despesa</option>
                         </select>
                       </div>
                       <div class="form-group">
                         <label class="sr-only" for="filtro-conta">Conta</label>
                         <select class="form-control" id="filtro-conta">
                           <option value="">Conta</option>
                         </select>
                       </div>
                       <div class="form-group">
                         <label class="sr-only" for="filtro-categoria">Categoria</label>
                         <select class="form-control" id="filtro-categoria">
                           <option value="">Categoria</option>
                         </select>
                       </div>
                     </form>
		                 </div>
	                  </div>
                  </div>
                </div>
        <div class="box box-primary">
            <div class="box-body">

            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection
