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
       /* $numeroAlumnos = Alumno::select(DB::raw("count(id) as total"))        
            ->get()->toArray();
        $numeroAlumnos= array_column($numeroAlumnos, 'total');*/
        
       
       
              
        return view('home');
             //->with('numeroAlumnos',json_encode($numeroAlumnos,JSON_NUMERIC_CHECK));
    }
}
