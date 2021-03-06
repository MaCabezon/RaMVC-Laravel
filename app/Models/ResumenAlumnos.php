<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ResumenAlumnos
 * @package App\Models
 * @version March 23, 2018, 1:55 pm UTC
 *
 * @property string persona
 * @property integer idEvento
 * @property date fechaEvento
 * @property decimal horas
 */
class ResumenAlumnos extends Model
{
    use SoftDeletes;

    public $table = 'resumen_alumnos';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'idAlumno',
        'idEvento',
        'fechaEvento',
        'validado',
        'horas',
        'justificante'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'idAlumno' => 'string',
        'idEvento' => 'integer',
        'fechaEvento' => 'date',
        'justificante'=>'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'idAlumno' => 'required',
        'idEvento' => 'required',
        'fechaEvento' => 'required',
        'validado'=> 'required',
        'horas' => 'required'
    ];

    public function scopeAlumno($query, $alumno)
    {
        $alumnos = config('options.alumnos');

        if ($alumnos != null && isset($alumnos[$alumno]))
        {
          $query->where('Alumno', 'LIKE', $alumno);
        }
    }


}
