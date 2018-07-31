<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller (Controlador de Reseteo de Constraseñas)
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    | Este controlador es responsable de gestionar el reseteo de las
    | contraseñas de los emails y un asistente que envia esas notificaciones
    | desde tu aplicacion a tus usuarios. Sientete libre de explorar esta clase.
    |
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Crea una nueva instancia del controlador.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
