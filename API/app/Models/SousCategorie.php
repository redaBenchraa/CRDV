<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SousCategorie
 * @package App\Models
 * @version January 9, 2018, 12:20 am UTC
 *
 * @property \App\Models\Categorie categorie
 * @property \Illuminate\Database\Eloquent\Collection acte
 * @property \Illuminate\Database\Eloquent\Collection Activite
 * @property \Illuminate\Database\Eloquent\Collection categorieProfessionnelle
 * @property \Illuminate\Database\Eloquent\Collection emploiDuTemps
 * @property integer categorie_id
 * @property string intitule
 * @property boolean type
 */
class SousCategorie extends Model
{
    use SoftDeletes;

    public $table = 'sousCategorie';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'categorie_id',
        'intitule',
        'type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'categorie_id' => 'integer',
        'id' => 'integer',
        'intitule' => 'string',
        'type' => 'boolean'
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
    public function categorie()
    {
        return $this->belongsTo(\App\Models\Categorie::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function activites()
    {
        return $this->hasMany(\App\Models\Activite::class);
    }
}
