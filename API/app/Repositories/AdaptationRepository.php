<?php

namespace App\Repositories;

use App\Models\Adaptation;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AdaptationRepository
 * @package App\Repositories
 * @version January 8, 2018, 11:52 pm UTC
 *
 * @method Adaptation findWithoutFail($id, $columns = ['*'])
 * @method Adaptation find($id, $columns = ['*'])
 * @method Adaptation first($columns = ['*'])
*/
class AdaptationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'nom'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Adaptation::class;
    }
}
