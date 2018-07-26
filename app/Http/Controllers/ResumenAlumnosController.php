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
use Maatwebsite\Excel\Facades\Excel;
use DB;
use App\Models\Eventos;
use App\Models\ResumenAlumnos;
//Nuevas
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;


class ResumenAlumnosController extends AppBaseController
{
    /** @var  ResumenAlumnosRepository */
    private $resumenAlumnosRepository;

    public function __construct(ResumenAlumnosRepository $resumenAlumnosRepo)
    {
        $this->resumenAlumnosRepository = $resumenAlumnosRepo;
        $this->middleware('permission:resumenAlumnos-list', ['only' => ['index']]);
        $this->middleware('permission:resumenAlumnos-show', ['only' => ['show']]);
        $this->middleware('permission:resumenAlumnos-create', ['only' => ['create','store']]);
        $this->middleware('permission:resumenAlumnos-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:resumenAlumnos-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the ResumenAlumnos.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
      $hasFilter = false;
      $resumenAlumnos = null;
      $alumno = Input::get('alumnos');
      $evento = Input::get('eventos');

      // eliminamos validaciones innecesarias y ponemos la fecha de hoy por defecto en ambas variables
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
        $resumenAlumnosCompleto = DB::table('resumenalum')
            ->orderBy('fechaEvento', 'DESC')
            ->take(50)
            ->get();
      }
      else if (\Auth::user()->hasRole('member'))
      {
        $resumenAlumnosCompleto = DB::table('resumenalum')
            ->where('nombre','Becas I')
            ->orWhere('nombre', 'Becas II')
            ->orWhere('nombre', 'Intervencion Agil I')
            ->orWhere('nombre','Intervencion Agil II')
            ->orderBy('fechaEvento', 'DESC')
            ->get();
      }
      else if (\Auth::user()->hasRole('user'))
      {
        $resumenAlumnosCompleto = DB::table('resumenalum')
            ->where('nombreProfesor',str_before(\Auth::user()->email,'@'))
            ->orderBy('fechaEvento', 'DESC')
            ->get();
      }

      // Seleccion de datos con FILTRO
      if (\Auth::user()->hasRole('admin'))
      {
        $query = DB::table('resumenalum');

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
        if ($alumno != null) {
          $query->where('idAlumno',$alumno);
        }

        $resumenAlumnos = $query->orderBy('fechaEvento', 'DESC')->get();
      }
      else if (\Auth::user()->hasRole('member'))
      {
        $query = DB::table('resumenalum');

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
            if ($alumno != null) {
              $query->where('idAlumno',$alumno);
            }

            $resumenAlumnos = $query->orderBy('fechaEvento', 'DESC')->get();
      }
      else if (\Auth::user()->hasRole('user'))
      {
        $query = DB::table('resumenalum')
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
            if ($alumno != null) {
              $query->where('idAlumno',$alumno);
            }

            $resumenAlumnos = $query->orderBy('fechaEvento', 'DESC')->get();
      }


      if (is_null($resumenAlumnos))
      {
        return view('resumen_alumnos.index', ["hasFilter" => $hasFilter]);
      }
      else
      {
        return view('resumen_alumnos.index', ["hasFilter" => $hasFilter, "resumenAlumnos" => $resumenAlumnos, "f1" => $f1, "f2" => $f2, "resumenAlumnosCompleto" => $resumenAlumnosCompleto]);
      }

    }

    /**
     * Show the form for creating a new ResumenAlumnos.
     *
     * @return Response
     */
    public function create()
    {
        $listaEventos  = Eventos::pluck('nombre', 'id');
        return view('resumen_alumnos.create')->with('eventos',$listaEventos);
    }
    /**
     * Crear Transacciones a traves de los datos de apk.
     *
     * @param Request $request
     * @return Response
     */
    public function justificarHoras(Request $resultado)
    {

            if($resultado!=""){


            $resumenAlumno=new ResumenAlumnos();
            $resumenAlumno->idAlumno=$resultado['idPersona'];
            $resumenAlumno->idEvento=$resultado['idEvento'];
            $resumenAlumno->fechaEvento=$resultado['fechaEvento'];
            $resumenAlumno->horas=$resultado['horas'];
            $resumenAlumno->validado=$resultado['validado'];
            $resumenAlumno->justificante=$resultado['justificante'];
            $resumenAlumno->save();
        }
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

        Flash::success('Resumen Alumnos guardado exitosamente.');

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
        //$resumenAlumnos = $this->resumenAlumnosRepository->findWithoutFail($id);
        $resumenAlumnos=DB::table('resumenalum')->find($id);

        if (empty($resumenAlumnos)) {
            Flash::error('Resumen Alumnos no encontrado');

            return redirect(route('resumenAlumnos.index'));
        }

        return view('resumen_alumnos.show')->with('resumenAlumnos', $resumenAlumnos);
    }
     /**
     * Display a listing of the ResumenAlumnos.
     *
     * @param Request $request
     * @return Response
     */

    public function dashboard(Request $request)
    {
        $resumenDashboard= DB::select('select Alumno,sum(horas) from resumenalumnos group by Evento');

        return view('dashboard.index')
            ->with('datos', $resumenDashboard);
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
        $listaEventos  = Eventos::pluck('nombre', 'id');


        if (empty($resumenAlumnos)) {
            Flash::error('Resumen Alumnos no encontrado');

            return redirect(route('resumenAlumnos.index'));
        }

        return view('resumen_alumnos.edit')->with('resumenAlumnos', $resumenAlumnos)->with('eventos', $listaEventos);
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
            Flash::error('Resumen Alumnos no encontrado');

            return redirect(route('resumenAlumnos.index'));
        }

        $resumenAlumnos = $this->resumenAlumnosRepository->update($request->all(), $id);

        Flash::success('Resumen Alumnos actualizado exitosamente.');

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
        //$resumenAlumnos = $this->resumenAlumnosRepository->findWithoutFail($id);
        $resumenAlumnos=DB::table('resumen_alumnos')->find($id);
        if (empty($resumenAlumnos)) {
            Flash::error('Resumen Alumnos no encontrado');

            return redirect(route('resumenAlumnos.index'));
        }

        //$this->resumenAlumnosRepository->delete($id);
        DB::table('resumen_alumnos')->delete($id);

        Flash::success('Resumen Alumnos borrado exitosamente.');

        return redirect(route('resumenAlumnos.index'));
    }

    /**
     * Generate report
     *
     *
     *
     * @return Response
     */
    public function excel (){

        Excel::create('Reporte Alumnos', function($excel) {

            $excel->sheet('Datos', function($sheet) {

                //headers
                $sheet->mergeCells('A1:D1');
                $sheet->row(1,['Informe de Asistencias']);
                $sheet->cells('A1', function ($cells) {
                    $cells->setBackground('#1EAAFF');
                    $cells->setAlignment('center');
                    $cells->setFontSize(30);
                    $cells->setBorder('thin','thin','thin','thin');
                });

                $sheet->row(2,['Alumno','Evento','Horas','Objetivo Cumplido']);
                $sheet->row(2, function ($cells) {
                    $cells->setBackground('#55D6BF');
                    $cells->setAlignment('center');
                    $cells->setFontSize(12);
                    $cells->setBorder('thin','thin','thin','thin');
                });

                //data
              //$resumenes=DB::table('reporte')->select('Alumno', 'Evento','Horas')->where('Evento','Becas I')->orWhere('Evento', 'Becas II')->orWhere('Evento', 'Intervencion Agil I')->orWhere('Evento','Intervencion Agil II')->orderby('Evento','asc')->orderby('Alumno','asc')->get();
              if (\Auth::user()->hasRole('admin')) {
                $resumenes=DB::table('reporte')->select('Alumno', 'Evento','Horas')->orderby('Evento','asc')->orderby('Alumno','asc')->get();
              } else if (\Auth::user()->hasRole('member')) {
                $resumenes=DB::table('reporte')->select('Alumno', 'Evento','Horas')->where('Evento','Becas I')->orWhere('Evento', 'Becas II')->orWhere('Evento', 'Intervencion Agil I')->orWhere('Evento','Intervencion Agil II')->get();
              } else if (\Auth::user()->hasRole('user')) {
                $resumenes=DB::table('reporte')->select('Alumno', 'Evento','Horas')->where('Profesor',str_before(\Auth::user()->email,'@'))->orderby('Evento','asc')->orderby('Alumno','asc')->get();
              }
              $rowNumber = 3; // Numero de columnas por el cual empieza
                foreach ($resumenes as $resumen) {
                    $row=[];
                    $row[1]=$resumen->Alumno;
                    $row[2]=$resumen->Evento;
                    $row[3]=$resumen->Horas;

                    // Calculamos el porcentaje de asistencia
                    $porcentaje = ($row[3]*100)/20;
                    $row[4] = $porcentaje."%";

                    $sheet->appendRow($row);

                    // Vemos si la fila es impar o par para cambiar el color de fondo y demás formatos
                    if ($rowNumber%2!=0) {
                      $sheet->row($rowNumber, function ($cells) {
                        $cells->setBackground('#FFFFFF');
                        $cells->setAlignment('center');
                        $cells->setFontSize(12);
                        $cells->setBorder('thin','thin','thin','thin');
                      });
                    } else {
                      $sheet->row($rowNumber, function ($cells) {
                        $cells->setBackground('#B1CAD9');
                        $cells->setAlignment('center');
                        $cells->setFontSize(12);
                        $cells->setBorder('thin','thin','thin','thin');
                      });
                    }

                    // Nombres alineados a la izquierda
                    $sheet->cells("A".$rowNumber, function($cells) {
                      $cells->setAlignment('left');
                    });

                    // Aplicamos color segun el porcentaje de asistencia
                    if ($porcentaje>=90) {
                      $sheet->cells("D".$rowNumber, function ($cells) {
                        $cells->setBackground('#6CF159');
                        $cells->setBorder('thin','thin','thin','thin');
                      });
                    } else if ($porcentaje>=60) {
                      $sheet->cells("D".$rowNumber, function ($cells) {
                        $cells->setBackground('#F8E64F');
                        $cells->setBorder('thin','thin','thin','thin');
                      });
                    } else {
                      $sheet->cells("D".$rowNumber, function ($cells) {
                        $cells->setBackground('#F15959');
                        $cells->setBorder('thin','thin','thin','thin');
                      });
                    }

                    $rowNumber = $rowNumber + 1;
                }
                $sheet->setOrientation('landscape');

            });

        })->export('xls');

        return redirect()->route('resumenAlumnos.index');

    }
    /**
     * Generate report
     *
     *
     *
     * @return Response
     */
    public function reporteTable(){

        if (\Auth::user()->hasRole('admin')) {
            $resumenes=DB::table('reportedatos')->select('Alumno', 'Evento','Horas')->orderby('Evento','asc')->orderby('Alumno','asc')->get();
          } else if (\Auth::user()->hasRole('member')) {
            $resumenes=DB::table('reportedatos')->select('Alumno', 'Evento','Horas')->where('Evento','Becas I')->orWhere('Evento', 'Becas II')->orWhere('Evento', 'Intervencion Agil I')->orWhere('Evento','Intervencion Agil II')->get();
          } else if (\Auth::user()->hasRole('user')) {
            $resumenes=DB::table('reportedatos')->select('Alumno', 'Evento','Horas')->where('Profesor',str_before(\Auth::user()->email,'@'))->orderby('Evento','asc')->orderby('Alumno','asc')->get();
          }


          //data


          $data=[];
            foreach ($resumenes as $resumen) {
                $row=[];
                $row['alumno']=$resumen->Alumno;
                $row['evento']=$resumen->Evento;               
                $row['horas']=$resumen->Horas;

                // Calculamos el porcentaje de asistencia
                $porcentaje = ($row['horas']*100)/20;
                $row['porcentaje'] = $porcentaje."%";
                array_push($data,$row);
            }


         return view('reportes.index')->with('data', $data);
    }

    public function obtenerDatosBecarios()
    {

            $vista = DB::select('SELECT reportedatos.*, resumenalumnos.Estado FROM reportedatos INNER JOIN resumenalumnos ON reportedatos.Alumno = resumenalumnos.Alumno
                 AND reportedatos.Evento = resumenalumnos.Evento AND reporte.Grupo = resumenalumnos.Grupo WHERE (reportedatos.Evento LIKE "Becas%" OR reportedatos.Evento
                 LIKE "Intervencion Agil%") AND WEEK(resumenalumnos.fechaEvento) = WEEK(CURDATE()) ORDER BY Evento, Alumno ASC');
        header('Content-Type: application/json');
        return json_encode($vista);
    }

    public function obtenerHoras(Request $resultado){
      $resultado['idPersona']='miguel.cabezon';

      //HORAS DIARIAS
      $horasNow=  DB::select("SELECT SEC_TO_TIME(TIMESTAMPDIFF(SECOND,max(fechaEvento),now())) Horas from transacciones where idPersona=:id and (idEvento=221 or idEvento=220 or idEvento=207 or IdEvento=208)",['id'=>$resultado->idPersona]);
    
      $horasAcumuladas=DB::table('resumen_alumnos')->select(DB::raw('SUM(horas) as HorasTotales'))->where('idAlumno',$resultado->idPersona)->where('horas','<>','-1.00')
      ->where('fechaEvento','curdate()')->orWhere('idEvento',220)->orWhere('idEvento',221)->orWhere('idEvento',207)->orWhere('idEvento',208)->get();

       //HORAS MENSULAES
       /*$horasMensuales=DB::table('reportediario')->select(DB::raw('SUM(HorasDia) as Horas'))->where('Alumno',$resultado->idPersona)
       ->orWhere('Evento','Becas I')->orWhere('Evento','Becas II')->orWhere('Evento','Intervencion Agil I')->orWhere('Evento','Intervencion Agil II')->whereRaw('WEEK(fechaEvento) = WEEK(CURDATE()')->get();

      //HORAS MENSULAES
      $horasMensuales=DB::table('reportediario')->select(DB::raw('SUM(HorasDia) as Horas'))->where('Alumno',$resultado->idPersona)
      ->orWhere('Evento','Becas I')->orWhere('Evento','Becas II')->orWhere('Evento','Intervencion Agil I')->orWhere('Evento','Intervencion Agil II')->whereRaw('MONTH(fechaEvento) = MONTH(CURDATE()')->get();

      //HORAS TOTALES DEL AÑO
      $horasTotales=DB::table('reportediario')->select(DB::raw('SUM(HorasDia) as Horas'))->where('Alumno',$resultado->idPersona)
      ->orWhere('Evento','Becas I')->orWhere('Evento','Becas II')->orWhere('Evento','Intervencion Agil I')->orWhere('Evento','Intervencion Agil II')->get();*/

      
      if($horasAcumuladas!=null){
       return $horasNow;
     }
       return $horasNow+$horasAcumuladas;
     
    }


}
