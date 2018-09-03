<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller (Controlador de reseteo de Controlador)
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    | Este controlador es responsable de gestionar las peticiones de reseteo
    | de contraseña. Eres libre de explorar este rasgo y sobreescribir
    | cualquier método que desees.
    |
    */

    use ResetsPasswords;

    /**
     * A dondo redirigir usuarios después de resetear la contraseña.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
