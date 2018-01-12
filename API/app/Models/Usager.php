<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Usager
 * @package App\Models
 * @version January 9, 2018, 12:31 am UTC
 *
 * @property \App\Models\Centre centre
 * @property \Illuminate\Database\Eloquent\Collection Acte
 * @property \Illuminate\Database\Eloquent\Collection Activite
 * @property \Illuminate\Database\Eloquent\Collection categorieProfessionnelle
 * @property \Illuminate\Database\Eloquent\Collection emploiDuTemps
 * @property integer centre_id
 * @property string nom
 * @property string prenom
 * @property integer age
 */
class Usager extends Model
{
    use SoftDeletes;

    public $table = 'usager';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'centre_id',
        'groupe_id',
        'nom',
        'prenom',
        'date_de_naissance'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'centre_id' => 'integer',
        'groupe_id' => 'integer',
        'nom' => 'string',
        'prenom' => 'string',
        'date_de_naissance' => 'date'
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function groupe()
    {
        return $this->belongsTo(\App\Models\Groupe::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function actes()
    {
        return $this->hasMany(\App\Models\Acte::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function activites()
    {
        return $this->hasMany(\App\Models\Activite::class);
    }
}
