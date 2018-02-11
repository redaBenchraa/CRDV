<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
class Professionnelle extends Authenticatable
{
    use SoftDeletes; 
    use Notifiable;
    use HasApiTokens;

    public $table = 'professionnelle';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'centre_id',
        'username',
        'nom',
        'prenom',
        'password',
        'type'
    ];

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'centre_id' => 'integer',
        'username' => 'string',
        'nom' => 'string',
        'prenom' => 'string',
        'password' => 'string',
        'type' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'username' => 'required',
       'password' => 'required'
        
    ];


    public function findForPassport($username) {
        return $this->where('username', $username)->first();
    }

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
