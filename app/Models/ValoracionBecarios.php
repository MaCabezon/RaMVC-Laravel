<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ValoracionBecarios
 * @package App\Models
 * @version July 31, 2018, 6:40 am UTC
 *
 * @property string idAlumno
 * @property string curso
 * @property integer formaTrabajo
 * @property integer actitud
 * @property integer manejoTecnologia
 * @property integer adaptacion
 * @property integer responsabilidad
 * @property string cumplimientoHoras
 * @property string materias
 * @property string annio
 */
class ValoracionBecarios extends Model
{
    use SoftDeletes;

    public $table = 'valoracion_becarios';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'idAlumno',
        'curso',
        'formaTrabajo',
        'actitud',
        'manejoTecnologia',
        'adaptacion',
        'responsabilidad',
        'cumplimientoHoras',
        'materias',
        'annio'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'idAlumno' => 'string',
        'curso' => 'string',
        'formaTrabajo' => 'integer',
        'actitud' => 'integer',
        'manejoTecnologia' => 'integer',
        'adaptacion' => 'integer',
        'responsabilidad' => 'integer',
        'cumplimientoHoras' => 'string',
        'materias' => 'string',
        'annio' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'idAlumno' => 'required',
        'curso' => 'required',
        'formaTrabajo' => 'required',
        'actitud' => 'required',
        'manejoTecnologia' => 'required',
        'adaptacion' => 'required',
        'responsabilidad' => 'required',
        'cumplimientoHoras' => 'required',
        'materias' => 'required',
        'annio' => 'required'
    ];

    
}
