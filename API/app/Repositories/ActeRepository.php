<?php

namespace App\Repositories;

use App\Models\Acte;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ActeRepository
 * @package App\Repositories
 * @version January 8, 2018, 11:52 pm UTC
 *
 * @method Acte findWithoutFail($id, $columns = ['*'])
 * @method Acte find($id, $columns = ['*'])
 * @method Acte first($columns = ['*'])
*/
class ActeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'usager_id',
        'acte_id',
        'duree',
        'modeSaisie'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Acte::class;
    }
}
