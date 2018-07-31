<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateResumenEventosRequest;
use App\Http\Requests\UpdateResumenEventosRequest;
use App\Repositories\ResumenEventosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response,DB;
use App\Models\Eventos;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;


class ResumenEventosController extends AppBaseController
{
    /** @var  ResumenEventosRepository */
    private $resumenEventosRepository;

    public function __construct(ResumenEventosRepository $resumenEventosRepo)
    {
        $this->resumenEventosRepository = $resumenEventosRepo;
        $this->middleware('permission:resumenEventos-list');
        $this->middleware('permission:resumenEventos-show', ['only' => ['show']]);
        $this->middleware('permission:resumenEventos-create', ['only' => ['create','store']]);
        $this->middleware('permission:resumenEventos-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:resumenEventos-delete', ['only' => ['destroy']]);
    }

    /**
     * Muestra un listado de los objetos ResumenEventos.
     *
     * @param Request $request
     * @return Response
     */
     public function index(Request $request)
     {
       $hasFilter = false;
       $resumenEventos = null;
       $evento = Input::get('eventos');

       // Eliminamos validaciones innecesarias y ponemos la fecha de hoy por defecto en ambas variables
       $f1 = $f2 = null;//date('Y-m-d');

       if(! is_null($request->fechaInicial) || ! empty($request->fechaInicial) && ! is_null($request->fechaFinal) || ! empty($request->fechaFinal))
       {
          $f1 = $request->fechaInicial;
          $f2 = $request->fechaFinal;
          $hasFilter = true;
       }
       elseif (is_null($request->fechaFinal) || empty($request->fechaFinal))
       {
         $f2 = date('Y-m-d');
       }
       if (!is_null($request->fechaInicial) || !is_null($request->fechaFinal) || !is_null($request->alumnos) || !is_null($request->eventos))
       {
         $hasFilter = true;
       }

       // Seleccion de datos SIN FILTRO (Para el SELECT)
       if (\Auth::user()->hasRole('admin'))
       {
         $resumenEventosCompleto = DB::table('resumeneventos')
             ->orderBy('fechaEvento', 'DESC')
             ->take(50)
             ->get();
       }
       else if (\Auth::user()->hasRole('member'))
       {
         $resumenEventosCompleto = DB::table('resumeneventos')
             ->where('nombre','Becas I')
             ->orWhere('nombre', 'Becas II')
             ->orWhere('nombre', 'Intervencion Agil I')
             ->orWhere('nombre','Intervencion Agil II')
             ->orderBy('fechaEvento', 'DESC')
             ->get();
       }
       else if (\Auth::user()->hasRole('user'))
       {
         $resumenEventosCompleto = DB::table('resumeneventos')
             ->where('nombreProfesor',str_before(\Auth::user()->email,'@'))
             ->orderBy('fechaEvento', 'DESC')
             ->get();
       }

       // Seleccion de datos con FILTRO
       if (\Auth::user()->hasRole('admin'))
       {
         $query = DB::table('resumeneventos');

         if (!is_null($f1) && is_null($f2)) {
           $f2 = date('Y-m-d');
           $query->whereBetween('fechaEvento', [$f1, $f2]);
         }
         if (is_null($f1) && !is_null($f2)) {
           $query->where('fechaEvento', '<=', $f2);
         }
         if (!is_null($f1) && !is_null($f2)) {
           $query->whereBetween('fechaEvento', [$f1, $f2]);
         }

         if ($evento != null) {
           $query->where('nombre',$evento);
         }

         $resumenEventos = $query->orderBy('fechaEvento', 'DESC')
             ->get();
       }
       else if (\Auth::user()->hasRole('member'))
       {
         $query = DB::table('resumeneventos')
             ->where('nombre','Becas I')
             ->orWhere('nombre', 'Becas II')
             ->orWhere('nombre', 'Intervencion Agil I')
             ->orWhere('nombre','Intervencion Agil II');

             if (!is_null($f1) && is_null($f2)) {
               $f2 = date('Y-m-d');
               $query->whereBetween('fechaEvento', [$f1, $f2]);
             }
             if (is_null($f1) && !is_null($f2)) {
               $query->where('fechaEvento', '<=', $f2);
             }
             if (!is_null($f1) && !is_null($f2)) {
               $query->whereBetween('fechaEvento', [$f1, $f2]);
             }

             if ($evento != null) {
               $query->where('nombre',$evento);
             }

             $resumenEventos = $query->orderBy('fechaEvento', 'DESC')
                 ->get();
       }
       else if (\Auth::user()->hasRole('user'))
       {
         $query = DB::table('resumeneventos')
             ->where('nombreProfesor',str_before(\Auth::user()->email,'@'));

             if (!is_null($f1) && is_null($f2)) {
               $f2 = date('Y-m-d');
               $query->whereBetween('fechaEvento', [$f1, $f2]);
             }
             if (is_null($f1) && !is_null($f2)) {
               $query->where('fechaEvento', '<=', $f2);
             }
             if (!is_null($f1) && !is_null($f2)) {
               $query->whereBetween('fechaEvento', [$f1, $f2]);
             }

             if ($evento != null) {
               $query->where('nombre',$evento);
             }

             $resumenEventos = $query->orderBy('fechaEvento', 'DESC')
                 ->get();
       }


       if (is_null($resumenEventos))
       {
         return view('resumen_eventos.index', ["hasFilter" => $hasFilter]);
       }
       else
       {
         return view('resumen_eventos.index', ["hasFilter" => $hasFilter, "resumenEventos" => $resumenEventos, "f1" => $f1, "f2" => $f2, "resumenEventosCompleto" => $resumenEventosCompleto]);
       }

     }

    /**
     * Muestra el formulario para la creación de un nuevo objeto ResumenEventos.
     *
     * @return Response
     */
    public function create()
    {
        $listaEventos  = Eventos::pluck('nombre', 'id');
        return view('resumen_eventos.create')->with('eventos',$listaEventos);
    }

    /**
     * Almacena un nuevo objeto ResumenAlumnos creado en la base de datos.
     *
     * @param CreateResumenEventosRequest $request
     *
     * @return Response
     */
    public function store(CreateResumenEventosRequest $request)
    {
        $input = $request->all();

        $resumenEventos = $this->resumenEventosRepository->create($input);

        Flash::success('Resumen Eventos guardado exitosamente.');

        return redirect(route('resumenEventos.index'));
    }

    /**
     * Muestra el objeto ResumenEventos deseado.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $resumenEventos=DB::table('resumeneventos')->find($id);

        if (empty($resumenEventos)) {
            Flash::error('Resumen Eventos no encontrado');

            return redirect(route('resumenEventos.index'));
        }

        return view('resumen_eventos.show')->with('resumenEventos', $resumenEventos);
    }

    /**
     * Muestra el formulario para poder editar un objeto ResumenEventos especifico.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $resumenEventos = $this->resumenEventosRepository->findWithoutFail($id);
        $listaEventos  = Eventos::pluck('nombre', 'id');

        if (empty($resumenEventos)) {
            Flash::error('Resumen Eventos no encontrado');

            return redirect(route('resumenEventos.index'));
        }

        return view('resumen_eventos.edit')->with('resumenEventos', $resumenEventos)->with('eventos', $listaEventos);
    }

    /**
     * Actualiza un objeto ResumenEventos específico de la base de datos.
     *
     * @param  int              $id
     * @param UpdateResumenEventosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateResumenEventosRequest $request)
    {
        $resumenEventos = $this->resumenEventosRepository->findWithoutFail($id);

        if (empty($resumenEventos)) {
            Flash::error('Resumen Eventos no encontrado');

            return redirect(route('resumenEventos.index'));
        }

        $resumenEventos = $this->resumenEventosRepository->update($request->all(), $id);

        Flash::success('Resumen Eventos actualizado exitosamente.');

        return redirect(route('resumenEventos.index'));
    }

    /**
     * Elimina un objeto ResumenEventos específico de la base de datos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $resumenEventos=DB::table('resumen_eventos')->find($id);

        if (empty($resumenEventos)) {
            Flash::error('Resumen Eventos no encontrado');

            return redirect(route('resumenEventos.index'));
        }

        $resumenEventos=DB::table('resumen_eventos')->delete($id);

        Flash::success('Resumen Eventos borrado exitosamente.');

        return redirect(route('resumenEventos.index'));
    }
}
