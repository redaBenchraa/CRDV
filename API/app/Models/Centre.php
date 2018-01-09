<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Centre
 * @package App\Models
 * @version January 8, 2018, 11:52 pm UTC
 *
 * @property \App\Models\Parametre parametre
 * @property \Illuminate\Database\Eloquent\Collection acte
 * @property \Illuminate\Database\Eloquent\Collection Categorie
 * @property \Illuminate\Database\Eloquent\Collection categorieProfessionnelle
 * @property \Illuminate\Database\Eloquent\Collection emploiDuTemps
 * @property \Illuminate\Database\Eloquent\Collection Professionnelle
 * @property \Illuminate\Database\Eloquent\Collection Usager
 * @property integer parametre_id
 * @property string nom
 * @property string adresse
 * @property string telephone
 */
class Centre extends Model
{
    use SoftDeletes;

    public $table = 'centre';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'parametre_id',
        'nom',
        'adresse',
        'telephone'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'parametre_id' => 'integer',
        'nom' => 'string',
        'adresse' => 'string',
        'telephone' => 'string'
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
    public function parametre()
    {
        return $this->belongsTo(\App\Models\Parametre::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function categories()
    {
        return $this->hasMany(\App\Models\Categorie::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function professionnelles()
    {
        return $this->hasMany(\App\Models\Professionnelle::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function usagers()
    {
        return $this->hasMany(\App\Models\Usager::class);
    }
}
