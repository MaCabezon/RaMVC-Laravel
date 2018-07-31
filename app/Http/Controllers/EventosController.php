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
         $this->middleware('permission:eventos-list');
         $this->middleware('permission:eventos-show', ['only' => ['show']]);
         $this->middleware('permission:eventos-create', ['only' => ['create','store']]);
         $this->middleware('permission:eventos-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:eventos-delete', ['only' => ['destroy']]);
    }

    /**
     * Muestra un listado de los objetos Eventos.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->eventosRepository->pushCriteria(new RequestCriteria($request));

         $eventos = $this->eventosRepository->all();
         return view('eventos.index')
            ->with('eventos', $eventos);
    }

    /**
     * Muestra el formulario para la creación de un nuevo objeto Eventos.
     *
     * @return Response
     */
    public function create()
    {
        return view('eventos.create');
    }

    /**
     * Almacena un nuevo objeto Eventos creado en la base de datos.
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
     * Muestra el objeto Eventos deseado.
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
     * Muestra el formulario para poder editar un objeto Eventos especifico.
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
     * Actualiza un objeto Eventos específico de la base de datos.
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
     * Elimina un objeto Eventos específico de la base de datos.
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
