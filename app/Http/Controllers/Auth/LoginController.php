<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller (Controlador de Login)
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    | Este controlador gestiona la autentificacion de usuarios en la
    | aplicacion y los redirige a la pantalla home. El controlador usa esta
    | caracteristica para proveer convenientemente funcionalidad a tus
    | aplicaciones.
    |
    */

    use AuthenticatesUsers;

    /**
     * A donde redirigir a los usuarios despues del logueo.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Crea una nueva instantica del controlador.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

}
