<?php

namespace App\Repositories;

use App\Models\ValoracionBecarios;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ValoracionBecariosRepository
 * @package App\Repositories
 * @version July 31, 2018, 6:40 am UTC
 *
 * @method ValoracionBecarios findWithoutFail($id, $columns = ['*'])
 * @method ValoracionBecarios find($id, $columns = ['*'])
 * @method ValoracionBecarios first($columns = ['*'])
*/
class ValoracionBecariosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
     * Configure the Model
     **/
    public function model()
    {
        return ValoracionBecarios::class;
    }
}
