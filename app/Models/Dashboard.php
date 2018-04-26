<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Dashboard
 * @package App\Models
 * @version April 20, 2018, 10:45 am UTC
 *
 * @property string Alumno
 * @property string Evento
 * @property string Grupo
 * @property string Estado
 * @property date fechaEvento
 */
class Dashboard extends Model
{
    use SoftDeletes;

    public $table = 'resumenalumnos';


    public $fillable = [
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];


}
