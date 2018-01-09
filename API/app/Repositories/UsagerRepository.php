<?php

namespace App\Repositories;

use App\Models\Usager;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UsagerRepository
 * @package App\Repositories
 * @version January 8, 2018, 11:52 pm UTC
 *
 * @method Usager findWithoutFail($id, $columns = ['*'])
 * @method Usager find($id, $columns = ['*'])
 * @method Usager first($columns = ['*'])
*/
class UsagerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'centre_id',
        'nom',
        'prenom',
        'age'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Usager::class;
    }
}
