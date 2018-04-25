<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use DateTime;
use Illuminate\Http\Request;
class Feedback extends Mailable
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
    public function build(Request $resultado)
    {

      //Decodificamos el formato json del array y lo guardamos en la variable $datos
      //$datos = json_decode(file_get_contents('php://input'),true);


      //Comprobamos que $datos contiene información
      if ($resultado != "")
      {
          $valores = ["feedback" => $resultado['feedback'], "valido" => $resultado['valido'], "sender" => $resultado['sender']];

          /*foreach ($datos as $key => $value)
          {
            $valores[$key] = $value;
          }*/

          if ($valores['valido'] == true)
          {
  			if ($valores['sender']!=null) {
  				$msg = $valores['feedback']."\nEnviado por ".$valores['sender'];
  			} else {
  				$msg = $valores['feedback'];
  			}

  			$hora = new DateTime();
  			$hora = $hora->format("Y-m-d H:i:s");
        $asunto = "Feedback [".$hora."]";


          }

      }

      return $this->view('emails.feedback')
                  ->from('rap@uneatlantico.es','Soporte')
                  ->subject($asunto)
                  ->with('msg',$msg);
    }
}
