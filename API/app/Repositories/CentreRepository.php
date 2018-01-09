<?php

namespace App\Repositories;

use App\Models\Centre;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CentreRepository
 * @package App\Repositories
 * @version January 8, 2018, 11:52 pm UTC
 *
 * @method Centre findWithoutFail($id, $columns = ['*'])
 * @method Centre find($id, $columns = ['*'])
 * @method Centre first($columns = ['*'])
*/
class CentreRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'parametre_id',
        'nom',
        'adresse',
        'telephone'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Centre::class;
    }
}
