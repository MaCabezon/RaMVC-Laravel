<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

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
                $sheet->mergeCells('A1:D1');
                $sheet->row(1,['Informe de Asistencias']);
                $sheet->row(2,['Alumno','Evento','Fecha','Horas']);

                //data
               $resumenes=DB::table('resumenalumnos')->select('Alumno', 'Evento','fechaEvento',DB::raw('SUM(Horas) as Horas'))
                                                      ->where('Estado', 'desactivado')
                                                      ->groupBy('Alumno')
                                                      ->get();

                foreach ($resumenes as $resumen) {
                    $row=[];                    
                    $row[1]=$resumen->Alumno;
                    $row[2]=$resumen->Evento;
                    $row[3]=$resumen->fechaEvento;
                    $row[4]=$resumen->Horas;

                    $sheet->appendRow($row);
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
