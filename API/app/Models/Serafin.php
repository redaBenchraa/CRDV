<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Serafin
 * @package App\Models
 * @version January 18, 2018, 10:21 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection categorieprofessionnelle
 * @property \Illuminate\Database\Eloquent\Collection Souscategorie
 * @property \Illuminate\Database\Eloquent\Collection usager
 * @property string code
 * @property string intitule
 * @property integer serafin_id
 */
class Serafin extends Model
{
    use SoftDeletes;

    public $table = 'serafin';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'code',
        'intitule',
        'serafin_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'code' => 'string',
        'intitule' => 'string',
        'serafin_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function souscategories()
    {
        return $this->hasMany(\App\Models\Souscategorie::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function serafin()
    {
        return $this->belongsTo(\App\Models\Serafin::class);
    }
}
