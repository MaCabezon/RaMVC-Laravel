<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ResumenEventos
 * @package App\Models
 * @version March 23, 2018, 1:56 pm UTC
 *
 * @property integer idEvento
 * @property date fechaEvento
 * @property decimal horas
 */
class ResumenEventos extends Model
{
    use SoftDeletes;

    public $table = 'resumen_eventos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'idEvento',
        'fechaEvento',
        'horas'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'idEvento' => 'integer',
        'fechaEvento' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'idEvento' => 'required',
        'fechaEvento' => 'required',
        'horas' => 'required'
    ];

    
}
