<?php

namespace App\Repositories;

use App\Models\Categorie;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CategorieRepository
 * @package App\Repositories
 * @version January 8, 2018, 11:52 pm UTC
 *
 * @method Categorie findWithoutFail($id, $columns = ['*'])
 * @method Categorie find($id, $columns = ['*'])
 * @method Categorie first($columns = ['*'])
*/
class CategorieRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'centre_id',
        'intitule'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Categorie::class;
    }
}
