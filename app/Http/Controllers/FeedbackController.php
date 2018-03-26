<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $datoFeedback = Feedback();
      return view('Administracion/Feedback.index')->with('Feedback', $datoFeedback);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public  function Feedback()
    {
      //$feedback = new Feedback($this->adapter);

      //Decodificamos el formato json del array y lo guardamos en la variable $datos
      $datos = json_decode(file_get_contents('php://input'),true);


      //Comprobamos que $datos contiene información
      if ($datos != "")
      {
          $valores = ["feedback" => "", "valido" => ""];

          foreach ($datos as $key => $value)
          {
            $valores[$key] = $value;
          }

          if ($valores['valido'] == true)
          {
  		  $msg = $valores['feedback'];

  		  $hora = new DateTime();
  			$hora = $hora->format("Y-m-d H:i:s");
        $asunto = "Feedback [".$hora."]";

  		   mail("rap@uneatlantico.es",$asunto,$msg);
          }

      }
    }
}
