<?php

namespace App\Repositories;

use App\Models\Acte;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ActeRepository
 * @package App\Repositories
 * @version January 9, 2018, 12:30 am UTC
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
        'activite_id',
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
