<?php

namespace App\Repositories;

use App\Models\Parametre;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ParametreRepository
 * @package App\Repositories
 * @version January 8, 2018, 11:52 pm UTC
 *
 * @method Parametre findWithoutFail($id, $columns = ['*'])
 * @method Parametre find($id, $columns = ['*'])
 * @method Parametre first($columns = ['*'])
*/
class ParametreRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nom',
        'valeur',
        'type'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Parametre::class;
    }
}
