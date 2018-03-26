<?php

namespace App\Repositories;

use App\Models\ResumenEventos;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ResumenEventosRepository
 * @package App\Repositories
 * @version March 23, 2018, 1:56 pm UTC
 *
 * @method ResumenEventos findWithoutFail($id, $columns = ['*'])
 * @method ResumenEventos find($id, $columns = ['*'])
 * @method ResumenEventos first($columns = ['*'])
*/
class ResumenEventosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'idEvento',
        'fechaEvento',
        'horas'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ResumenEventos::class;
    }
}
