<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Eventos
 * @package App\Models
 * @version March 23, 2018, 1:45 pm UTC
 *
 * @property string abreviatura
 * @property string nombre
 * @property string grupo
 * @property string nombreProfesor
 */
class Eventos extends Model
{
    use SoftDeletes;

    public $table = 'eventos';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'abreviatura',
        'nombre',
        'grupo',
        'nombreProfesor'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'abreviatura' => 'string',
        'nombre' => 'string',
        'grupo' => 'string',
        'nombreProfesor' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'abreviatura' => 'required',
        'nombre' => 'required',
        'grupo' => 'required',
        'nombreProfesor' => 'required'
    ];


}
