<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * Lista de los tipos de excepcion que no deben ser reportados.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * Lista de las entradas que no deben apareceer para las excepciones de validacion.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Reporta o registra una excepcion.
     *
     * Ese es un buen punto para enviar excepcion a Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Renderiza una excepcion en una respuesta HTTP.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
            return response()->json(['User have not permission for this page access.']);
        }
        return parent::render($request, $exception);
    }
}
