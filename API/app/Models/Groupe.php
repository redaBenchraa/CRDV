<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Groupe
 * @package App\Models
 * @version January 12, 2018, 11:10 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection categorieprofessionnelle
 * @property \Illuminate\Database\Eloquent\Collection Emploidutemp
 * @property \Illuminate\Database\Eloquent\Collection Usager
 * @property string nom
 */
class Groupe extends Model
{
    use SoftDeletes;

    public $table = 'groupe';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nom'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nom' => 'string'
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
    public function emploidutemps()
    {
        return $this->hasMany(\App\Models\Emploidutemp::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function usagers()
    {
        return $this->hasMany(\App\Models\Usager::class);
    }
}
