<?php

namespace App\Repositories;

use App\Models\Usager;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UsagerRepository
 * @package App\Repositories
 * @version January 9, 2018, 12:31 am UTC
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
