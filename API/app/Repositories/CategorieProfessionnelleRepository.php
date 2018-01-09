<?php

namespace App\Repositories;

use App\Models\CategorieProfessionnelle;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CategorieProfessionnelleRepository
 * @package App\Repositories
 * @version January 9, 2018, 12:31 am UTC
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
