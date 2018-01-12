<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Acte
 * @package App\Models
 * @version January 9, 2018, 12:30 am UTC
 *
 * @property \App\Models\Activite activite
 * @property \App\Models\Usager usager
 * @property \Illuminate\Database\Eloquent\Collection Adaptation
 * @property \Illuminate\Database\Eloquent\Collection categorieProfessionnelle
 * @property \Illuminate\Database\Eloquent\Collection emploiDuTemps
 * @property integer usager_id
 * @property integer activite_id
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
    public function activites()
    {
        return $this->hasMany(\App\Models\Activite::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usager()
    {
        return $this->belongsTo(\App\Models\Usager::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function adaptations()
    {
        return $this->hasMany(\App\Models\Adaptation::class);
    }
}
