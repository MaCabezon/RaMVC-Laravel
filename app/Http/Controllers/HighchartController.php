<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HighchartController extends Controller
{
	// Controlador de las tablas
	public function highchart()
	{
		$chartActivoMateria = DB::select("SELECT count(Alumno) AS NumeroAlumnos,Evento,Estado FROM resumenalumnos WHERE fechaEvento=curdate() AND (Estado<>'P.Activado' AND Estado<>'P.Desactivado') GROUP BY Evento,Estado");
		$chartActivoGeneral = DB::select("SELECT count(Alumno) AS NumeroAlumnos,Estado FROM resumenalumnos WHERE fechaEvento=curdate() AND (Estado<>'P.Activado' AND Estado<>'P.Desactivado') GROUP BY Estado");
		$chartActivoBecarios = DB::select("SELECT count(ra.Alumno) AS NumeroAlumnos,ra.Evento,ra.Estado FROM resumenalumnos ra WHERE ra.fechaEvento=curdate() AND (Estado<>'P.Activado' AND Estado<>'P.Desactivado') AND (ra.Evento='Becas I' OR ra.Evento='Becas II'
	    	OR ra.Evento='Intervencion Agil I' OR ra.Evento='Intervencion Agil II') GROUP BY ra.Evento,ra.Estado");

		$data=[];
		$chartActivoMateria=HighchartController::crearhighchart($chartActivoMateria,true,"Numero de personas actuales en Clase");
		$chartActivoGeneral=HighchartController::crearhighchart($chartActivoGeneral,false,"Numero de personas actuales en la Universidad");
		$chartActivoBecarios=HighchartController::crearhighchart($chartActivoBecarios,true,"Numero de Becarios actuales en la Beca");

	  array_push ($data, $chartActivoMateria, $chartActivoGeneral,$chartActivoBecarios);

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
