<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HighchartController extends Controller
{

	public function highchart()
	{
	    $chartActivoMateria = DB::select("SELECT count(Alumno) as NumeroAlumnos,Evento,Estado FROM resumenalumnos where fechaEvento=curdate() and (Estado<>'P.Activado' and Estado<>'P.Desactivado') GROUP by Evento,Estado");

	    $chartActivoGeneral = DB::select("SELECT count(Alumno) as NumeroAlumnos,Estado FROM resumenalumnos where fechaEvento=curdate() and (Estado<>'P.Activado' and Estado<>'P.Desactivado') GROUP by Estado");

	    $chartActivoBecarios = DB::select("SELECT count(ra.Alumno) as NumeroAlumnos,ra.Evento,ra.Estado FROm resumenalumnos ra where ra.fechaEvento=curdate() and (Estado<>'P.Activado' and Estado<>'P.Desactivado') and(ra.Evento='Becas I' or ra.Evento='Becas II' 
	    	or ra.Evento='Intervencion Agil I' or ra.Evento='Intervencion Agil II') GROUP BY ra.Evento,ra.Estado");

		
		$data=[];
		$chartActivoMateria=HighchartController::crearhighchart($chartActivoMateria,true,"Numero de personas actuales en Clase");
		$chartActivoGeneral=HighchartController::crearhighchart($chartActivoGeneral,false,"Numero de personas actuales en la Universidad");
		$chartActivoBecarios=HighchartController::crearhighchart($chartActivoBecarios,true,"Numero de Becarios actuales en la Beca");	 
	    
	    array_push ($data, $chartActivoMateria, $chartActivoGeneral,$chartActivoBecarios);
	    
		
	   //return $chartActivoMateria;
	    return view ('highchart.index' )->withChartarray($data);
	    								
	 }

	 public static function crearhighchart($datos,$token,$titulo) {
		
		$chartArray ["chart"] = array (
				"type" => "column" 
		);
		$chartArray ["title"] = array (
				"text" => $titulo 
		);
		$chartArray ["credits"] = array (
				"enabled" => false 
		);
		
		$chartArray ["tooltip"] = array (
				"valueSuffix" => "" 
		);
		
		$categoryArray = array ();

		
		
		$activado= [ ];
		$desactivado = [ ];
		
		$dataArray = [ ];
		$estados = [ ];
		
		
		

		foreach ($datos as  $dat) {
		
			
			if($dat->Estado=='activado'){

				if(isset($estados[count($estados)-1]) && $estados[count($estados)-1]=='activado'){
					array_push ( $estados, 'desactivado' );
					array_push ( $desactivado, 0 );
					array_push ( $estados, 'activado' );
					array_push ( $activado, ( int ) $dat->NumeroAlumnos );


				}else{

					array_push ($estados,$dat->Estado);
					array_push ( $activado, ( int ) $dat->NumeroAlumnos );
				}

			}else if($dat->Estado=='desactivado'){

				if(isset($estados[count($estados)-1]) && $estados[count($estados)-1]=='desactivado'){
					array_push ( $estados, 'activado' );
					array_push ( $activado, 0 );
					array_push ( $estados, 'desactivado' );
					array_push ( $desactivado, ( int ) $dat->NumeroAlumnos );


				}else{
					
					array_push ($estados,$dat->Estado);
					array_push ( $desactivado, ( int ) $dat->NumeroAlumnos );
				}
			}
		}
		
		
		/*foreach ( $datos as $det ){
			if($det->Estado=='activado'){

				array_push ( $activado, ( int ) $det->NumeroAlumnos );

			} else if($det->Estado=='desactivado'){

				array_push ( $desactivado, ( int ) $det->NumeroAlumnos );
			}
		}*/

		
		$nombreEvento="";			

		if($token !=false){


			foreach ($datos as $evento ){
				if($nombreEvento!=$evento->Evento){
					array_push ( $categoryArray, $evento->Evento );
					$nombreEvento=$evento->Evento;
				}
			}
		}
		
		
		if(!empty($activado) && !empty($desactivado)){
			array_push ( $dataArray, $activado, $desactivado);
			

		}else if(!empty($desactivado)){
			array_push ( $dataArray, $desactivado);
			
		}else if(!empty($activado)){
			array_push ( $dataArray, $activado);
			
			
		}
		
		
		
		for($i = 0; $i < count ( $dataArray ); $i ++){
			$chartArray ["series"] [] = array (
					"name" => $estados [$i],
					"data" => $dataArray [$i] 
			);
		}

		
		$chartArray ["xAxis"] = array (
				"categories" => $categoryArray 
		);
		$chartArray ["yAxis"] = array (
				"title" => array (
						"text" => "Numero de Alumnos" 
				) 
		);
		
		return $chartArray;
	}
	            
}