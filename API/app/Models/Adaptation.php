<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Adaptation
 * @package App\Models
 * @version January 9, 2018, 12:30 am UTC
 *
 * @property \App\Models\Acte acte
 * @property \Illuminate\Database\Eloquent\Collection acte
 * @property \Illuminate\Database\Eloquent\Collection categorieProfessionnelle
 * @property \Illuminate\Database\Eloquent\Collection emploiDuTemps
 * @property integer acte_id
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
        'acte_id',
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
