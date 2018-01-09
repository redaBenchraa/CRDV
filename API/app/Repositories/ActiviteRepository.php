<?php

namespace App\Repositories;

use App\Models\Activite;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ActiviteRepository
 * @package App\Repositories
 * @version January 8, 2018, 11:52 pm UTC
 *
 * @method Activite findWithoutFail($id, $columns = ['*'])
 * @method Activite find($id, $columns = ['*'])
 * @method Activite first($columns = ['*'])
*/
class ActiviteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'professionnelle_id',
        'usager_id',
        'categorie_id',
        'sousCategorie_id',
        'duree',
        'cloture',
        'planifie'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Activite::class;
    }
}
