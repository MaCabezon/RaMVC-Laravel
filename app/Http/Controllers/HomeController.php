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
       /* $alumnosActivosBecasI = DB::table('resumenalumnos')->select('Alumno', 'Estado')->where('estado', 'activado')->where('Evento','Becas I');      
            ->get()->toArray();
        $alumnosActivosBecasI= array_column($numeroAlumnos, 'total');*/
        
       
       
              
        return view('home');
             //->with('numeroAlumnos',json_encode($numeroAlumnos,JSON_NUMERIC_CHECK));
    }
}
