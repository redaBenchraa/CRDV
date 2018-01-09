<?php

namespace App\Repositories;

use App\Models\CategorieProfessionnelle;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CategorieProfessionnelleRepository
 * @package App\Repositories
 * @version January 8, 2018, 11:52 pm UTC
 *
 * @method CategorieProfessionnelle findWithoutFail($id, $columns = ['*'])
 * @method CategorieProfessionnelle find($id, $columns = ['*'])
 * @method CategorieProfessionnelle first($columns = ['*'])
*/
class CategorieProfessionnelleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'categorie_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CategorieProfessionnelle::class;
    }
}
