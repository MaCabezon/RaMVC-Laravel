<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventosRequest;
use App\Http\Requests\UpdateEventosRequest;
use App\Repositories\EventosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Eventos;
use DB;

class EventosController extends AppBaseController
{
    /** @var  EventosRepository */
    private $eventosRepository;

    public function __construct(EventosRepository $eventosRepo)
    {
        $this->eventosRepository = $eventosRepo;
    }

    /**
     * Display a listing of the Eventos.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, $idPersona)
    {
        $this->eventosRepository->pushCriteria(new RequestCriteria($request));
        $eventos = $this->eventosRepository->where('nombreProfesor',$idPersona)->orderBy('nombre', 'ASC')->all();

        return view('eventos.index')
            ->with('eventos', $eventos);
    }

    /**
     * Show the form for creating a new Eventos.
     *
     * @return Response
     */
    public function create()
    {
        return view('eventos.create');
    }

    /**
     * Store a newly created Eventos in storage.
     *
     * @param CreateEventosRequest $request
     *
     * @return Response
     */
    public function store(CreateEventosRequest $request)
    {
        $input = $request->all();

        $eventos = $this->eventosRepository->create($input);

        Flash::success('Eventos guardado exitosamente.');

        return redirect(route('eventos.index'));
    }

    /**
     * Display the specified Eventos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $eventos = $this->eventosRepository->findWithoutFail($id);

        if (empty($eventos)) {
            Flash::error('Eventos no encotnrado');

            return redirect(route('eventos.index'));
        }

        return view('eventos.show')->with('eventos', $eventos);
    }

    /**
     * Show the form for editing the specified Eventos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $eventos = $this->eventosRepository->findWithoutFail($id);

        if (empty($eventos)) {
            Flash::error('Eventos no encontrado');

            return redirect(route('eventos.index'));
        }

        return view('eventos.edit')->with('eventos', $eventos);
    }

    /**
     * Update the specified Eventos in storage.
     *
     * @param  int              $id
     * @param UpdateEventosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEventosRequest $request)
    {
        $eventos = $this->eventosRepository->findWithoutFail($id);

        if (empty($eventos)) {
            Flash::error('Eventos no encontrado');

            return redirect(route('eventos.index'));
        }

        $eventos = $this->eventosRepository->update($request->all(), $id);

        Flash::success('Eventos actualizado exitosamente.');

        return redirect(route('eventos.index'));
    }

    /**
     * Remove the specified Eventos from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $eventos = $this->eventosRepository->findWithoutFail($id);

        if (empty($eventos)) {
            Flash::error('Eventos no encontrado');

            return redirect(route('eventos.index'));
        }

        $this->eventosRepository->delete($id);

        Flash::success('Eventos borrado exitosamente.');

        return redirect(route('eventos.index'));
    }


}
