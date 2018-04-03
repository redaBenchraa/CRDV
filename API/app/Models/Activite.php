<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Activite
 * @package App\Models
 * @version January 9, 2018, 12:30 am UTC
 *
 * @property \App\Models\SousCategorie sousCategorie
 * @property \App\Models\Usager usager
 * @property \App\Models\Professionnelle professionnelle
 * @property \Illuminate\Database\Eloquent\Collection Acte
 * @property \Illuminate\Database\Eloquent\Collection categorieProfessionnelle
 * @property \Illuminate\Database\Eloquent\Collection EmploiDuTemp
 * @property integer professionnelle_id
 * @property integer usager_id
 * @property integer categorie_id
 * @property integer sous_categorie_id
 * @property integer duree
 * @property boolean cloture
 * @property boolean planifie
 */
class Activite extends Model
{
    use SoftDeletes;

    public $table = 'activite';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'professionnelle_id',
        'usager_id',
        'groupe_id',
        'categorie_id',
        'sous_categorie_id',
        'acte_id',
        'duree',
        'cloture',
        'planifie',
        'date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'professionnelle_id' => 'integer',
        'usager_id' => 'integer',
        'groupe_id' => 'integer',
        'categorie_id' => 'integer',
        'sous_categorie_id' => 'integer',
        'acte_id' => 'integer',
        'duree' => 'integer',
        'cloture' => 'boolean',
        'planifie' => 'boolean',
        'date' => 'date'
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
    public function sousCategorie()
    {
        return $this->belongsTo(\App\Models\SousCategorie::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usager()
    {
        return $this->belongsTo(\App\Models\Usager::class);
    }
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
    public function professionnelle()
    {
        return $this->belongsTo(\App\Models\Professionnelle::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function acte()
    {
        return $this->belongsTo(\App\Models\Acte::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function emploiDuTemps()
    {
        return $this->hasMany(\App\Models\EmploiDuTemps::class);
    }
}
