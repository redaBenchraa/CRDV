<?php

namespace App\Repositories;

use App\Models\Serafin;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SerafinRepository
 * @package App\Repositories
 * @version January 18, 2018, 10:21 pm UTC
 *
 * @method Serafin findWithoutFail($id, $columns = ['*'])
 * @method Serafin find($id, $columns = ['*'])
 * @method Serafin first($columns = ['*'])
*/
class SerafinRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'intitule',
        'serafin_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Serafin::class;
    }
}
