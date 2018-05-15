<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Transacciones
 * @package App\Models
 * @version March 23, 2018, 1:52 pm UTC
 *
 * @property string persona
 * @property integer idEvento
 * @property string|\Carbon\Carbon fechaEvento
 * @property string|\Carbon\Carbon fechaRegistro
 * @property enum tipo
 * @property boolean validado
 */
class Transacciones extends Model
{
    use SoftDeletes;

    public $table = 'transacciones';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'idPersona',
        'idEvento',
        'fechaEvento',
        'fechaRegistro',
        'tipo',       
        'validado'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'idPersona' => 'string',
        'idEvento' => 'integer',
        'tipo' => 'string',        
        'validado' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'idPersona' => 'required',
        'idEvento' => 'required',
        'fechaEvento' => 'required',
        'tipo' => 'required',            
        'validado' => 'required'
    ];

    
}
