<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateResumenAlumnosRequest;
use App\Http\Requests\UpdateResumenAlumnosRequest;
use App\Repositories\ResumenAlumnosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ResumenAlumnosController extends AppBaseController
{
    /** @var  ResumenAlumnosRepository */
    private $resumenAlumnosRepository;

    public function __construct(ResumenAlumnosRepository $resumenAlumnosRepo)
    {
        $this->resumenAlumnosRepository = $resumenAlumnosRepo;
    }

    /**
     * Display a listing of the ResumenAlumnos.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->resumenAlumnosRepository->pushCriteria(new RequestCriteria($request));
        $resumenAlumnos = $this->resumenAlumnosRepository->all();

        return view('resumen_alumnos.index')
            ->with('resumenAlumnos', $resumenAlumnos);
    }

    /**
     * Show the form for creating a new ResumenAlumnos.
     *
     * @return Response
     */
    public function create()
    {
        return view('resumen_alumnos.create');
    }

    /**
     * Store a newly created ResumenAlumnos in storage.
     *
     * @param CreateResumenAlumnosRequest $request
     *
     * @return Response
     */
    public function store(CreateResumenAlumnosRequest $request)
    {
        $input = $request->all();

        $resumenAlumnos = $this->resumenAlumnosRepository->create($input);

        Flash::success('Resumen Alumnos saved successfully.');

        return redirect(route('resumenAlumnos.index'));
    }

    /**
     * Display the specified ResumenAlumnos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $resumenAlumnos = $this->resumenAlumnosRepository->findWithoutFail($id);

        if (empty($resumenAlumnos)) {
            Flash::error('Resumen Alumnos not found');

            return redirect(route('resumenAlumnos.index'));
        }

        return view('resumen_alumnos.show')->with('resumenAlumnos', $resumenAlumnos);
    }

    /**
     * Show the form for editing the specified ResumenAlumnos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $resumenAlumnos = $this->resumenAlumnosRepository->findWithoutFail($id);

        if (empty($resumenAlumnos)) {
            Flash::error('Resumen Alumnos not found');

            return redirect(route('resumenAlumnos.index'));
        }

        return view('resumen_alumnos.edit')->with('resumenAlumnos', $resumenAlumnos);
    }

    /**
     * Update the specified ResumenAlumnos in storage.
     *
     * @param  int              $id
     * @param UpdateResumenAlumnosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateResumenAlumnosRequest $request)
    {
        $resumenAlumnos = $this->resumenAlumnosRepository->findWithoutFail($id);

        if (empty($resumenAlumnos)) {
            Flash::error('Resumen Alumnos not found');

            return redirect(route('resumenAlumnos.index'));
        }

        $resumenAlumnos = $this->resumenAlumnosRepository->update($request->all(), $id);

        Flash::success('Resumen Alumnos updated successfully.');

        return redirect(route('resumenAlumnos.index'));
    }

    /**
     * Remove the specified ResumenAlumnos from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $resumenAlumnos = $this->resumenAlumnosRepository->findWithoutFail($id);

        if (empty($resumenAlumnos)) {
            Flash::error('Resumen Alumnos not found');

            return redirect(route('resumenAlumnos.index'));
        }

        $this->resumenAlumnosRepository->delete($id);

        Flash::success('Resumen Alumnos deleted successfully.');

        return redirect(route('resumenAlumnos.index'));
    }

    public function excel (){
        
        Excel::create('Reporte Alumnos', function($excel) {

            $excel->sheet('Datos', function($sheet) {

                //headers
                $sheet->mergeCells('A1:D1');
                $sheet->row(1,['Informe de Asistencias']);
                $sheet->row(2,['Alumno','Evento','Horas']);

                //data
                $resumenes=ResumenAlumnos::all();

                foreach ($resumenes as $resumen) {
                    $row=[];                    
                    $row[1]=$resumen->idAlumno;
                    $row[2]=$resumen->Materia;
                    $row[2]=$resumen->FechaEvento;
                    $row[2]=$resumen->Horas;

                    $sheet->appendRow($row);
                }
                $sheet->setOrientation('landscape');

            });

        })->export('xls');

        return redirect()->route('resumenAlumnos.index');

    }
}
