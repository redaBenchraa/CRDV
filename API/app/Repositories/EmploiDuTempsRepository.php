<?php

namespace App\Repositories;

use App\Models\EmploiDuTemps;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EmploiDuTempsRepository
 * @package App\Repositories
 * @version January 9, 2018, 12:31 am UTC
 *
 * @method EmploiDuTemps findWithoutFail($id, $columns = ['*'])
 * @method EmploiDuTemps find($id, $columns = ['*'])
 * @method EmploiDuTemps first($columns = ['*'])
*/
class EmploiDuTempsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'professionnelle_id',
        'groupe_id',
        'acte_id',
        'jour',
        'heureDebut',
        'heureFin'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return EmploiDuTemps::class;
    }
}
