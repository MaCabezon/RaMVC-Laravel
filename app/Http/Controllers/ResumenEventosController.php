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
     * Display a listing of the ResumenEventos.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
      if (\Auth::user()->hasRole('admin')) {
        $resumenEventos=DB::table('resumeneventos')->get();
      } else if (\Auth::user()->hasRole('member')) {
        $resumenEventos=DB::table('resumeneventos')->where('nombre','Becas I')->orWhere('nombre', 'Becas II')->orWhere('nombre', 'Intervencion Agil I')->orWhere('nombre','Intervencion Agil II')->get();
      } else if (\Auth::user()->hasRole('user')) {
        $resumenEventos=DB::table('resumeneventos')->where('nombreProfesor',str_before(\Auth::user()->email,'@'))->get(); 
      }

        return view('resumen_eventos.index')
            ->with('resumenEventos', $resumenEventos);
    }

    /**
     * Show the form for creating a new ResumenEventos.
     *
     * @return Response
     */
    public function create()
    {
        $listaEventos  = Eventos::pluck('nombre', 'id');
        return view('resumen_eventos.create')->with('eventos',$listaEventos);
    }

    /**
     * Store a newly created ResumenEventos in storage.
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
     * Display the specified ResumenEventos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //$resumenEventos = $this->resumenEventosRepository->findWithoutFail($id);
        $resumenEventos=DB::table('resumeneventos')->find($id);

        if (empty($resumenEventos)) {
            Flash::error('Resumen Eventos no encontrado');

            return redirect(route('resumenEventos.index'));
        }

        return view('resumen_eventos.show')->with('resumenEventos', $resumenEventos);
    }

    /**
     * Show the form for editing the specified ResumenEventos.
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
     * Update the specified ResumenEventos in storage.
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
     * Remove the specified ResumenEventos from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //$resumenEventos = $this->resumenEventosRepository->findWithoutFail($id);
        $resumenEventos=DB::table('resumen_eventos')->find($id);

        if (empty($resumenEventos)) {
            Flash::error('Resumen Eventos no encontrado');

            return redirect(route('resumenEventos.index'));
        }

        //$this->resumenEventosRepository->delete($id);
        $resumenEventos=DB::table('resumen_eventos')->delete($id);

        Flash::success('Resumen Eventos borrado exitosamente.');

        return redirect(route('resumenEventos.index'));
    }
}
