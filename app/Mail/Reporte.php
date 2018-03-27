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

        });

        return $this->view('emails.reporte')
                    ->from('rap@uneatlantico.es','Soporte')
                    ->subject('Reporte Diario')
                    ->attach($file->store("xls",false,true)['full']);
    }
}
