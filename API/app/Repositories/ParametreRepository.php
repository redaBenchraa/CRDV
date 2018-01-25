<?php

namespace App\Repositories;

use App\Models\Parametre;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ParametreRepository
 * @package App\Repositories
 * @version January 9, 2018, 12:31 am UTC
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
        'type',
        'centre_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Parametre::class;
    }
}
