<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HighchartController extends Controller
{
	/*public function highchart()
	{
	    $viewer = View::select(DB::raw("SUM(numberofview) as count"))
	        ->orderBy("created_at")
	        ->groupBy(DB::raw("year(created_at)"))
	        ->get()->toArray();
	    $viewer = array_column($viewer, 'count');
	    
	    $click = Click::select(DB::raw("SUM(numberofclick) as count"))
	        ->orderBy("created_at")
	        ->groupBy(DB::raw("year(created_at)"))
	        ->get()->toArray();
	    $click = array_column($click, 'count');
	    return view('highchart')
	            ->with('viewer',json_encode($viewer,JSON_NUMERIC_CHECK))
	            ->with('click',json_encode($click,JSON_NUMERIC_CHECK));
	}*/

	public function highchart()
	{
	    $numeroAlumnos = View::select(DB::raw("count(id) as total"))        
	        ->get()->toArray();
	    $numeroAlumnos= array_column($numeroAlumnos, 'total');
	    
	   
	    return view('highchart')
	            ->with('numeroAlumnos',json_encode($numeroAlumnos,JSON_NUMERIC_CHECK))
	 }
	            
}