<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Parametre
 * @package App\Models
 * @version January 9, 2018, 12:31 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection acte
 * @property \Illuminate\Database\Eloquent\Collection categorieProfessionnelle
 * @property \Illuminate\Database\Eloquent\Collection Centre
 * @property \Illuminate\Database\Eloquent\Collection emploiDuTemps
 * @property integer nom
 * @property integer valeur
 * @property integer type
 */
class Parametre extends Model
{
    use SoftDeletes;

    public $table = 'parametre';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nom',
        'valeur',
        'type',
        'centre_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nom' => 'string',
        'valeur' => 'string',
        'type' => 'integer',
        'centre_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     **/
    public function centre()
    {
        return $this->belongsTo(\App\Models\Centre::class);
    }
}
