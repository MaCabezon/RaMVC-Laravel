<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateValoracionBecariosRequest;
use App\Http\Requests\UpdateValoracionBecariosRequest;
use App\Repositories\ValoracionBecariosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ValoracionBecariosController extends AppBaseController
{
    /** @var  ValoracionBecariosRepository */
    private $valoracionBecariosRepository;

    public function __construct(ValoracionBecariosRepository $valoracionBecariosRepo)
    {
        $this->valoracionBecariosRepository = $valoracionBecariosRepo;
    }

    /**
     * Display a listing of the ValoracionBecarios.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->valoracionBecariosRepository->pushCriteria(new RequestCriteria($request));
        $valoracionBecarios = $this->valoracionBecariosRepository->all();

        return view('valoracion_becarios.index')
            ->with('valoracionBecarios', $valoracionBecarios);
    }

    /**
     * Show the form for creating a new ValoracionBecarios.
     *
     * @return Response
     */
    public function create()
    {
        return view('valoracion_becarios.create');
    }

    /**
     * Store a newly created ValoracionBecarios in storage.
     *
     * @param CreateValoracionBecariosRequest $request
     *
     * @return Response
     */
    public function store(CreateValoracionBecariosRequest $request)
    {
        $input = $request->all();

        $valoracionBecarios = $this->valoracionBecariosRepository->create($input);

        Flash::success('Valoracion Becarios saved successfully.');

        return redirect(route('valoracionBecarios.index'));
    }

    /**
     * Display the specified ValoracionBecarios.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $valoracionBecarios = $this->valoracionBecariosRepository->findWithoutFail($id);

        if (empty($valoracionBecarios)) {
            Flash::error('Valoracion Becarios not found');

            return redirect(route('valoracionBecarios.index'));
        }

        return view('valoracion_becarios.show')->with('valoracionBecarios', $valoracionBecarios);
    }

    /**
     * Show the form for editing the specified ValoracionBecarios.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $valoracionBecarios = $this->valoracionBecariosRepository->findWithoutFail($id);

        if (empty($valoracionBecarios)) {
            Flash::error('Valoracion Becarios not found');

            return redirect(route('valoracionBecarios.index'));
        }

        return view('valoracion_becarios.edit')->with('valoracionBecarios', $valoracionBecarios);
    }

    /**
     * Update the specified ValoracionBecarios in storage.
     *
     * @param  int              $id
     * @param UpdateValoracionBecariosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateValoracionBecariosRequest $request)
    {
        $valoracionBecarios = $this->valoracionBecariosRepository->findWithoutFail($id);

        if (empty($valoracionBecarios)) {
            Flash::error('Valoracion Becarios not found');

            return redirect(route('valoracionBecarios.index'));
        }

        $valoracionBecarios = $this->valoracionBecariosRepository->update($request->all(), $id);

        Flash::success('Valoracion Becarios updated successfully.');

        return redirect(route('valoracionBecarios.index'));
    }

    /**
     * Remove the specified ValoracionBecarios from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $valoracionBecarios = $this->valoracionBecariosRepository->findWithoutFail($id);

        if (empty($valoracionBecarios)) {
            Flash::error('Valoracion Becarios not found');

            return redirect(route('valoracionBecarios.index'));
        }

        $this->valoracionBecariosRepository->delete($id);

        Flash::success('Valoracion Becarios deleted successfully.');

        return redirect(route('valoracionBecarios.index'));
    }
}
