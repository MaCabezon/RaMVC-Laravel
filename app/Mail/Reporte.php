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
}
