<?php

namespace App\Repositories;

use App\Models\ResumenAlumnos;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ResumenAlumnosRepository
 * @package App\Repositories
 * @version March 23, 2018, 1:55 pm UTC
 *
 * @method ResumenAlumnos findWithoutFail($id, $columns = ['*'])
 * @method ResumenAlumnos find($id, $columns = ['*'])
 * @method ResumenAlumnos first($columns = ['*'])
*/
class ResumenAlumnosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'persona',
        'idEvento',
        'fechaEvento',
        'horas'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ResumenAlumnos::class;
    }
}
