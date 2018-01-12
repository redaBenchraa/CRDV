<?php

namespace App\Repositories;

use App\Models\Groupe;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class GroupeRepository
 * @package App\Repositories
 * @version January 12, 2018, 11:10 pm UTC
 *
 * @method Groupe findWithoutFail($id, $columns = ['*'])
 * @method Groupe find($id, $columns = ['*'])
 * @method Groupe first($columns = ['*'])
*/
class GroupeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nom'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Groupe::class;
    }
}
