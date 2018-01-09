<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Adaptation
 * @package App\Models
 * @version January 8, 2018, 11:52 pm UTC
 *
 * @property \App\Models\Acte acte
 * @property \Illuminate\Database\Eloquent\Collection acte
 * @property \Illuminate\Database\Eloquent\Collection categorieProfessionnelle
 * @property \Illuminate\Database\Eloquent\Collection emploiDuTemps
 * @property integer id
 * @property integer nom
 */
class Adaptation extends Model
{
    use SoftDeletes;

    public $table = 'adaptation';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'id',
        'nom'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'acte_id' => 'integer',
        'id' => 'integer',
        'nom' => 'integer'
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
    public function acte()
    {
        return $this->belongsTo(\App\Models\Acte::class);
    }
}
