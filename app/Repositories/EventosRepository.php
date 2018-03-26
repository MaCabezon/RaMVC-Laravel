<?php

namespace App\Repositories;

use App\Models\Eventos;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EventosRepository
 * @package App\Repositories
 * @version March 23, 2018, 1:45 pm UTC
 *
 * @method Eventos findWithoutFail($id, $columns = ['*'])
 * @method Eventos find($id, $columns = ['*'])
 * @method Eventos first($columns = ['*'])
*/
class EventosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'abreviatura',
        'nombre',
        'grupo',
        'nombreProfesor'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Eventos::class;
    }
}
