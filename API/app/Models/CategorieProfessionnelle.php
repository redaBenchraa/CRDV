<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CategorieProfessionnelle
 * @package App\Models
 * @version January 9, 2018, 12:31 am UTC
 *
 * @property \App\Models\Categorie categorie
 * @property \App\Models\Professionnelle professionnelle
 * @property \Illuminate\Database\Eloquent\Collection acte
 * @property \Illuminate\Database\Eloquent\Collection emploiDuTemps
 * @property integer categorie_id
 */
class CategorieProfessionnelle extends Model
{
    use SoftDeletes;

    public $table = 'categorieProfessionnelle';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'categorie_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'professionnelle_id' => 'integer',
        'categorie_id' => 'integer'
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function professionnelle()
    {
        return $this->belongsTo(\App\Models\Professionnelle::class);
    }
}
