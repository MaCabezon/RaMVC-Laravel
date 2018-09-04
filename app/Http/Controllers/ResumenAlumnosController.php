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
       
        $this->middleware('permission:resumenAlumnos-list', ['only' => ['index']]);
        $this->middleware('permission:resumenAlumnos-show', ['only' => ['show']]);
        $this->middleware('permission:resumenAlumnos-create', ['only' => ['create','store']]);
        $this->middleware('permission:resumenAlumnos-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:resumenAlumnos-delete', ['only' => ['destroy']]);
        $this->resumenAlumnosRepository = $resumenAlumnosRepo;
    }

    /**
     * Muestra un listado de los objetos ResumenAlumnos.
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

      // Eliminamos validaciones innecesarias y ponemos la fecha de hoy por defecto en ambas variables
      $f1 = $f2 = null;

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
     * Muestra el formulario para la creación de un nuevo objeto ResumenAlumnos.
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
     * Almacena un nuevo objeto ResumenAlumnos creado en la base de datos.
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
     * Muestra el objeto ResumenAlumnos deseado.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $resumenAlumnos=DB::table('resumenalum')->find($id);

        if (empty($resumenAlumnos)) {
            Flash::error('Resumen Alumnos no encontrado');

            return redirect(route('resumenAlumnos.index'));
        }

        return view('resumen_alumnos.show')->with('resumenAlumnos', $resumenAlumnos);
    }
     /**
     * Muestra un listado de los objetos ResumenAlumnos.
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
     * Muestra el formulario para poder editar un objeto ResumenAlumnos especifico.
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
     * Actualiza un objeto ResumenAlumnos específico de la base de datos.
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
     * Elimina un objeto ResumenAlumnos específico de la base de datos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $resumenAlumnos=DB::table('resumen_alumnos')->find($id);
        if (empty($resumenAlumnos)) {
            Flash::error('Resumen Alumnos no encontrado');

            return redirect(route('resumenAlumnos.index'));
        }

        DB::table('resumen_alumnos')->delete($id);

        Flash::success('Resumen Alumnos borrado exitosamente.');

        return redirect(route('resumenAlumnos.index'));
    }

    /**
     * Genera un reporte
     *
     * @return Response
     */
    public function excel () {
        // Creamos un excel y le damos formato
        Excel::create('Reporte Alumnos', function($excel) {

            $excel->sheet('Datos', function($sheet) {

                // Cabecera
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

              // Datos
              if (\Auth::user()->hasRole('admin')) {
                $resumenes=DB::table('reporte')->select('Alumno', 'Evento','Horas')->orderby('Evento','asc')->orderby('Alumno','asc')->get();
              } else if (\Auth::user()->hasRole('member')) {
                $resumenes=DB::table('reporte')->select('Alumno', 'Evento','Horas')->where('Evento','Becas I')->orWhere('Evento', 'Becas II')->orWhere('Evento', 'Intervencion Agil I')->orWhere('Evento','Intervencion Agil II')->get();
              } else if (\Auth::user()->hasRole('user')) {
                $resumenes=DB::table('reporte')->select('Alumno', 'Evento','Horas')->where('Profesor',str_before(\Auth::user()->email,'@'))->orderby('Evento','asc')->orderby('Alumno','asc')->get();
              }

              $rowNumber = 3; // Numero de columnas por el cual empieza

                foreach ($resumenes as $resumen) {
                    $row = [];
                    $row[1] = $resumen->Alumno;
                    $row[2] = $resumen->Evento;

                    if ($resumen->Horas == null) {
                      $row[3] = 0;
                    } else {
                      $row[3] = $resumen->Horas;
                    }

                    // Calculamos el porcentaje de asistencia
                    $porcentaje = ($row[3]*100)/20;
                    $row[4] = $porcentaje."%";

                    $sheet->appendRow($row);

                    // Vemos si la fila es impar o par para cambiar el color de fondo y demás formatos (letra, borde, ...)
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

                    // Aumentamos el numero de la fila
                    $rowNumber = $rowNumber + 1;
                }

                $sheet->setOrientation('landscape');

            });

        })->export('xls');

        return redirect()->route('resumenAlumnos.index');

    }
    /**
     * Genera un reporte
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

          // Datos
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

        $vista = DB::select('SELECT reportedatos.*, resumenalumnos.Estado
                                  FROM reportedatos
                                  INNER JOIN resumenalumnos ON reportedatos.Alumno = resumenalumnos.Alumno
                                  AND reportedatos.Evento = resumenalumnos.Evento
                                  AND reporte.Grupo = resumenalumnos.Grupo
                                  WHERE (reportedatos.Evento LIKE "Becas%" OR reportedatos.Evento LIKE "Intervencion Agil%")
                                  AND WEEK(resumenalumnos.fechaEvento) = WEEK(CURDATE())
                                  ORDER BY Evento, Alumno ASC');
        header('Content-Type: application/json');
        return json_encode($vista);
    }

     public function obtenerHoras(Request $resultado){
     
      $resultado['idPersona']=$resultado['usuario'];

      $conectado=DB::select(DB::raw("SELECT * FROM resumen_alumnos where idAlumno=:id and horas ='-1.00' and 
      fechaEvento=curdate() and (idEvento=220 or idEvento=221 or idEvento=207 or idEvento=208) order by fechaEvento Desc limit 1 "),['id'=>$resultado->idPersona]);;
    
      if($conectado!=null && $conectado[0]->horas=="-1.00"){
      ;
      //HORAS DIARIAS
      $horasNow=  DB::select("SELECT cast( TIMESTAMPDIFF(minute, max(fechaEvento), now()) /60 as  decimal(5,2)) as Horas from transacciones where  idPersona=:id and (idEvento=221 or idEvento=220 or idEvento=207 or IdEvento=208)",['id'=>$resultado->idPersona]);
      }else{
        
        $horasNow=null;
      }
      
      $horasAcumuladas=DB::select(DB::raw("SELECT SUM(horas) as HorasTotales FROM resumen_alumnos where idAlumno=:id and horas <>'-1.00' and 
      fechaEvento=curdate() and (idEvento=220 or idEvento=221 or idEvento=207 or idEvento=208) "),['id'=>$resultado->idPersona]);
      //->Where('idEvento',220)->orWhere('idEvento',221)->orWhere('idEvento',207)
    // ->orWhere('idEvento',208)->where('idAlumno',$resultado->idPersona)->where('horas','<>','-1.00')->where('fechaEvento','curdate()')->get();
      
      //HORAS Semanales
     $horasSemanales=DB::select(DB::raw(" SELECT SUM(Horas) as HorasSemanales from resumen_alumnos where idAlumno=:id AND horas <> '-1.00'and
     week(fechaEvento)=week(curdate()) and (idEvento=220 or idEvento=221 or idEvento=207 or idEvento=208) "),
     ['id'=>$resultado->idPersona]);
     
      
      //HORAS MENSULAES
      $horasMensuales=DB::select(DB::raw("SELECT SUM(Horas) as HorasMensuales from resumen_alumnos where idAlumno=:id  and horas <> '-1.00'and
      month(fechaEvento)=month(curdate()) and (idEvento=220 or idEvento=221 or idEvento=207 or idEvento=208) "),
      ['id'=>$resultado->idPersona]);

     //HORAS TOTALES DEL AÑO
     $horasTotales=DB::select(DB::raw("SELECT SUM(Horas) as HorasTotales from resumen_alumnos where (fechaEvento BETWEEN '2018-09-01' and '2019-07-31') and idAlumno=:id and horas <> '-1.00'and
      (idEvento=220 or idEvento=221 or idEvento=207 or idEvento=208) "),['id'=>$resultado->idPersona]);
     
      
      if($horasNow==null){
       
        if($horasSemanales[0]->HorasSemanales!=null){
          $horasSemanales=$horasSemanales[0]->HorasSemanales;
        }else{
          $horasSemanales=0;
        }

        if($horasMensuales[0]->HorasMensuales!=null){
          $horasMensuales=$horasMensuales[0]->HorasMensuales ;
        }else{
          
          $horasMensuales=0;
        }

        if($horasTotales[0]->HorasTotales!=null){
          $horasTotales=$horasTotales[0]->HorasTotales ;
        } else{
          $horasTotales=0;
        }  

        if($horasAcumuladas[0]->HorasTotales!=null){   
               
          $horasDiarias= $horasAcumuladas[0]->HorasTotales;        
        
        }else{
         $horasDiarias=0;
        }
      }else{      

      
        if($horasSemanales[0]->HorasSemanales!=null){
          $horasSemanales=$horasSemanales[0]->HorasSemanales +$horasNow[0]->Horas;
        }else{
          $horasSemanales=$horasNow[0]->Horas;
        }

        if($horasMensuales[0]->HorasMensuales!=null){
          $horasMensuales=$horasMensuales[0]->HorasMensuales +$horasNow[0]->Horas;
        }else{
          
          $horasMensuales=$horasNow[0]->Horas;
        }

        if($horasTotales[0]->HorasTotales!=null){
          $horasTotales=$horasTotales[0]->HorasTotales +$horasNow[0]->Horas;
        } else{
          $horasTotales=$horasNow[0]->Horas;
        }  

        if($horasAcumuladas!=null){         
          $horasDiarias= $horasNow[0]->Horas+$horasAcumuladas[0]->HorasTotales;        
        
        }else{
         $horasDiarias= $horasNow[0]->Horas;
        }
      }
     
     return view('resumen_Alumnos.horas')->with('horasDiarias', $horasDiarias)
                              ->with('horasSemanales',$horasSemanales )
                              ->with('horasMensuales', $horasMensuales)
                              ->with('horasTotales', $horasTotales)
                              ->with('nombre',$resultado->idPersona);
    }


}
