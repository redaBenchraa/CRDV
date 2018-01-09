<?php

namespace App\Repositories;

use App\Models\SousCategorie;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SousCategorieRepository
 * @package App\Repositories
 * @version January 9, 2018, 12:20 am UTC
 *
 * @method SousCategorie findWithoutFail($id, $columns = ['*'])
 * @method SousCategorie find($id, $columns = ['*'])
 * @method SousCategorie first($columns = ['*'])
*/
class SousCategorieRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'categorie_id',
        'intitule',
        'type'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SousCategorie::class;
    }
}
