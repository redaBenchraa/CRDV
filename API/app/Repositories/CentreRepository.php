<?php

namespace App\Repositories;

use App\Models\Centre;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CentreRepository
 * @package App\Repositories
 * @version January 9, 2018, 12:31 am UTC
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
