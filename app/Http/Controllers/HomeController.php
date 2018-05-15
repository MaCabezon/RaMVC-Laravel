<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;
use DB, Session;

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
        $message=DB::table('resumen_alumnos')->where('validado', '0')->first();
        
        if ($message!="") {
            Session::flash('message', 'Hay alumnos pendientes.'); 
        }
              
       
       
              
        return view('home');
            // ->with('numeroAlumnos',json_encode($alumnosActivosBecasI,JSON_NUMERIC_CHECK));

    }
}
