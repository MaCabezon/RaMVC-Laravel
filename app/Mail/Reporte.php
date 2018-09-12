<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class Reporte extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $file=Excel::create('Reporte Alumnos', function($excel) {

            $excel->sheet('Datos', function($sheet) {

              //headers
              $sheet->mergeCells('A1:E1');
              $sheet->row(1,['Informe de Asistencias']);
              $sheet->cells('A1', function ($cells) {
                  $cells->setBackground('#1EAAFF');
                  $cells->setAlignment('center');
                  $cells->setFontSize(30);
                  $cells->setBorder('thin','thin','thin','thin');
              });

              $sheet->row(2,['Alumno','Evento','HorasDia','HorasTotales','Objetivo Cumplido']);
              $sheet->row(2, function ($cells) {
                  $cells->setBackground('#55D6BF');
                  $cells->setAlignment('center');
                  $cells->setFontSize(12);
                  $cells->setBorder('thin','thin','thin','thin');
              });

              //data
              $resumenes=DB::table('reporte')->select('Alumno', 'Evento','Horas','HorasDia')->where('Evento','Becas I')->orWhere('Evento', 'Becas II')->orWhere('Evento', 'Intervencion Agil I')->orWhere('Evento','Intervencion Agil II')->orderby('Evento','asc')->orderby('Alumno','asc')->get();


            $rowNumber = 3; // Numero de columnas por el cual empieza
              foreach ($resumenes as $resumen) {
                  $row=[];
                  $row[1]=$resumen->Alumno;
                  $row[2]=$resumen->Evento;
                  $row[3]=$resumen->HorasDia;
                  $row[4]=$resumen->Horas;

                  // Calculamos el porcentaje de asistencia
                  $porcentaje = ($row[4]*100)/20;
                  $row[5] = $porcentaje."%";

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
                    $sheet->cells("E".$rowNumber, function ($cells) {
                      $cells->setBackground('#6CF159');
                      $cells->setBorder('thin','thin','thin','thin');
                    });
                  } else if ($porcentaje>=60) {
                    $sheet->cells("E".$rowNumber, function ($cells) {
                      $cells->setBackground('#F8E64F');
                      $cells->setBorder('thin','thin','thin','thin');
                    });
                  } else {
                    $sheet->cells("E".$rowNumber, function ($cells) {
                      $cells->setBackground('#F15959');
                      $cells->setBorder('thin','thin','thin','thin');
                    });
                  }

                  $rowNumber = $rowNumber + 1;
              }
              $sheet->setOrientation('landscape');

            });

        });

        return $this->view('emails.reporte')
                    ->from('rap@uneatlantico.es','Soporte')
                    ->subject('Reporte Diario')
                    ->attach($file->store("xls",false,true)['full']);
    }


////////////////////////////// METODO INDEX //////////////////////////
    public function index (Request $request)
    {
      $hasFilter = false;
      $reportes = null;
      $alumno = Input::get('Alumno');
      $evento = Input::get('Evento');

      // Eliminamos validaciones innecesarias y ponemos la fecha de hoy por defecto en ambas variables
      $fecha = null;

      if(! is_null($request->fecha) || ! empty($request->fecha))
      {
        $fecha = $request->fecha;
        $hasFilter = true;
      }
      elseif (is_null($request->fecha) || empty($request->fecha))
      {
        $fecha = date('Y-m-d');
      }

      if (!is_null($request->fecha) || !is_null($request->alumnos) || !is_null($request->eventos))
      {
        $hasFilter = true;
      }

      // Seleccion de datos SIN FILTRO (Para el SELECT)
      if (\Auth::user()->hasRole('admin'))
      {
        $reportesCompleto = DB::table('reporte')
            ->orderBy('FechaEvento', 'DESC')
            ->take(50)
            ->get();
      }
      else if (\Auth::user()->hasRole('member'))
      {
        $reportesCompleto = DB::table('reporte')
            ->where('Evento','Becas I')
            ->orWhere('Evento', 'Becas II')
            ->orWhere('Evento', 'Intervencion Agil I')
            ->orWhere('Evento','Intervencion Agil II')
            ->orderBy('FechaEvento', 'DESC')
            ->get();
      }
      else if (\Auth::user()->hasRole('user'))
      {
        $reportesCompleto = DB::table('reporte')
            ->where('nombreProfesor',str_before(\Auth::user()->email,'@'))
            ->orderBy('FechaEvento', 'DESC')
            ->get();
      }

      // Seleccion de datos con FILTRO
      if (\Auth::user()->hasRole('admin'))
      {
        $query = DB::table('reporte');

        // Filtro de fecha
        if (is_null($fecha)) {
          $fecha = date('Y-m-d');
          $query->where('FechaEvento', $fecha);
        }
        if (!is_null($fecha)) {
          $query->where('FechaEvento', '<=', $fecha);
        }


        // Filtro de eventos
        if ($evento != null) {
          $query->where('Evento',$evento);
        }

        // Filtro de alumnos
        if ($alumno != null) {
          $query->where('Alumno',$alumno);
        }

        $reportes = $query->orderBy('FechaEvento', 'DESC')->get();
      }
      else if (\Auth::user()->hasRole('member'))
      {
        $query = DB::table('reporte');

            // Filtro de fecha
            if (is_null($fecha)) {
              $fecha = date('Y-m-d');
              $query->where('FechaEvento', $fecha);
            }
            if (!is_null($fecha)) {
              $query->where('FechaEvento', '<=', $fecha);
            }

            // Filtro de eventos
            if ($evento != null) {
              $query->where('Evento',$evento);
            }

            // Filtro de alumnos
            if ($alumno != null) {
              $query->where('Alumno',$alumno);
            }

            $reportes = $query->orderBy('FechaEvento', 'DESC')->get();
      }
      else if (\Auth::user()->hasRole('user'))
      {
        $query = DB::table('reporte')
            ->where('nombreProfesor',str_before(\Auth::user()->email,'@'));

            // Filtro de fecha
            if (is_null($fecha)) {
              $fecha = date('Y-m-d');
              $query->where('FechaEvento', $fecha);
            }
            if (!is_null($fecha)) {
              $query->where('FechaEvento', '<=', $fecha);
            }

            /*if (!is_null($f1) && !is_null($f2)) {
              $query->whereBetween('fechaEvento', [$f1, $f2]);
            }*/

            // Filtro de eventos
            if ($evento != null) {
              $query->where('Evento',$evento);
            }

            // Filtro de alumnos
            if ($alumno != null) {
              $query->where('Alumno',$alumno);
            }

            $reportes = $query->orderBy('FechaEvento', 'DESC')->get();
      }

      if (is_null($reportes))
      {
        return view('reportes.index', ["hasFilter" => $hasFilter]);
      }
      else
      {
        return view('reportes.index', ["hasFilter" => $hasFilter, "reportes" => $reportes, "fecha" => $fecha, "reportesCompleto" => $reportesCompleto]);
      }

    }
}
