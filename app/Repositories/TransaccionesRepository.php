<?php

namespace App\Repositories;

use App\Models\Transacciones;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TransaccionesRepository
 * @package App\Repositories
 * @version March 23, 2018, 1:52 pm UTC
 *
 * @method Transacciones findWithoutFail($id, $columns = ['*'])
 * @method Transacciones find($id, $columns = ['*'])
 * @method Transacciones first($columns = ['*'])
*/
class TransaccionesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'persona',
        'idEvento',
        'fechaEvento',
        'fechaRegistro',
        'tipo',
        'validado'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Transacciones::class;
    }
}
