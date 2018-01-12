<?php

namespace App\Repositories;

use App\Models\Professionnelle;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProfessionnelleRepository
 * @package App\Repositories
 * @version January 9, 2018, 12:31 am UTC
 *
 * @method Professionnelle findWithoutFail($id, $columns = ['*'])
 * @method Professionnelle find($id, $columns = ['*'])
 * @method Professionnelle first($columns = ['*'])
*/
class ProfessionnelleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'centre_id',
        'nom',
        'prenom',
        'password',
        'type'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Professionnelle::class;
    }
}
