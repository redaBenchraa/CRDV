<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Professionnelle
 * @package App\Models
 * @version January 9, 2018, 12:31 am UTC
 *
 * @property \App\Models\Centre centre
 * @property \Illuminate\Database\Eloquent\Collection acte
 * @property \Illuminate\Database\Eloquent\Collection Activite
 * @property \Illuminate\Database\Eloquent\Collection categorieProfessionnelle
 * @property \Illuminate\Database\Eloquent\Collection EmploiDuTemp
 * @property integer centre_id
 * @property string nom
 * @property string prenom
 */
class Professionnelle extends Model
{
    use SoftDeletes;

    public $table = 'professionnelle';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'centre_id',
        'nom',
        'prenom'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'centre_id' => 'integer',
        'nom' => 'string',
        'prenom' => 'string'
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
    public function centre()
    {
        return $this->belongsTo(\App\Models\Centre::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function activites()
    {
        return $this->hasMany(\App\Models\Activite::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function categories()
    {
        return $this->belongsToMany(\App\Models\Categorie::class, 'categorieProfessionnelle');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function emploiDuTemps()
    {
        return $this->hasMany(\App\Models\EmploiDuTemp::class);
    }
}
