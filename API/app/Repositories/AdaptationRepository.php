<?php

namespace App\Repositories;

use App\Models\Adaptation;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AdaptationRepository
 * @package App\Repositories
 * @version January 9, 2018, 12:30 am UTC
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
        'acte_id',
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
