<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eventos;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import()
    {
    	if (($handle = fopen ( public_path () . '/listadomaterias.csv', 'r' )) !== FALSE) {
		        while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {

			           $evento = new Eventos ();
			           $evento->abreviatura = $data [0];
			           $evento->nombre = $data [1];
			           $evento->grupo = $data [2];
			           $evento->nombreProfesor = $data [3];
			           $evento->save ();
		         }
		         fclose ( $handle );
	    }

	    return view('eventos.index');
	  }
}
