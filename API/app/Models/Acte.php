<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Acte
 * @package App\Models
 * @version January 8, 2018, 11:52 pm UTC
 *
 * @property \App\Models\Activite activite
 * @property \App\Models\Usager usager
 * @property \App\Models\Adaptation adaptation
 * @property \Illuminate\Database\Eloquent\Collection categorieProfessionnelle
 * @property \Illuminate\Database\Eloquent\Collection emploiDuTemps
 * @property integer usager_id
 * @property integer acte_id
 * @property integer duree
 * @property string modeSaisie
 */
class Acte extends Model
{
    use SoftDeletes;

    public $table = 'acte';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'usager_id',
        'activite_id',
        'duree',
        'modeSaisie'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'usager_id' => 'integer',
        'acte_id' => 'integer',
        'duree' => 'integer',
        'modeSaisie' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function activite()
    {
        return $this->belongsTo(\App\Models\Activite::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usager()
    {
        return $this->belongsTo(\App\Models\Usager::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function adaptation()
    {
        return $this->hasOne(\App\Models\Adaptation::class);
    }
}
