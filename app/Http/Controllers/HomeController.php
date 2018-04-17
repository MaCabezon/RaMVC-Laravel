<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumnosActivosBecasI = DB::table('resumenalumnos')->where('Estado', 'desactivado')->where('Evento','Estrategias de Aprendizaje y Competencias en TIC')->count();
            
        
        $alumnosActivosBecasI=["total"=>$alumnosActivosBecasI];
        
       
       
              
        return view('home')
             ->with('numeroAlumnos',json_encode($alumnosActivosBecasI,JSON_NUMERIC_CHECK));
    }
}
