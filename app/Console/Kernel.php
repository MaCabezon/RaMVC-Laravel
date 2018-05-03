<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Mail\Reporte as ReporteEmail;
use Mail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->call(function () {

            Mail::to('lazaro.hernandez@uneatlantico.es')->send(new ReporteEmail);
            //Mail::to('abraham.fernandez@alumnos.uneatlantico.es')->send(new ReporteEmail);
            Mail::to('juan.tortajada@uneatlantico.es')->send(new ReporteEmail);
            Mail::to('sara.berbil@alumnos.uneatlantico.es')->send(new ReporteEmail);
            Mail::to('loyda.alas@alumnos.uneatlantico.es')->send(new ReporteEmail);
            Mail::to('larisa.hernandez@alumnos.uneatlantico.es')->send(new ReporteEmail);

        })->everyMinute()
        ->before(function()
        {
        	echo "Ya enviare los correos...";
        })
        ->after(function(){
        	echo "He terminado de enviar las tareas";
        });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

     /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
        'Illuminate\Cookie\Middleware\EncryptCookies',
        'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
        'Illuminate\Session\Middleware\StartSession',
        'Illuminate\View\Middleware\ShareErrorsFromSession',
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'csrf'       => 'App\Http\Middleware\VerifyCsrfToken',
        'auth'       => 'App\Http\Middleware\Authenticate',
        'admin'      => 'App\Http\Middleware\VerifyAdmin',
        'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
        'guest'      => 'App\Http\Middleware\RedirectIfAuthenticated',
    ];
}
