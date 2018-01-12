<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EmploiDuTemps
 * @package App\Models
 * @version January 9, 2018, 12:31 am UTC
 *
 * @property \App\Models\Activite activite
 * @property \App\Models\Professionnelle professionnelle
 * @property \Illuminate\Database\Eloquent\Collection acte
 * @property \Illuminate\Database\Eloquent\Collection categorieProfessionnelle
 * @property integer professionnelle_id
 * @property integer acte_id
 * @property integer jour
 * @property time heureDebut
 * @property time heureFin
 */
class EmploiDuTemps extends Model
{
    use SoftDeletes;

    public $table = 'emploiDuTemps';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'professionnelle_id',
        'groupe_id',
        'acte_id',
        'jour',
        'heureDebut',
        'heureFin'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'professionnelle_id' => 'integer',
        'groupe_id' => 'integer',
        'acte_id' => 'integer',
        'jour' => 'integer'
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
    public function groupe()
    {
        return $this->belongsTo(\App\Models\Groupe::class);
    }

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
    public function professionnelle()
    {
        return $this->belongsTo(\App\Models\Professionnelle::class);
    }
}
