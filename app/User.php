<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Laravel\Passport\HasApiTokens;
use Faker;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;
    use HasApiTokens;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function peliculas()
    {
        return $this->hasMany('\App\Pelicula', 'idUser'); // modelo y clave foránea
    }

    // public function roles_usuario(){
    //     return $this->belongsToMany('\App\Rol','role_user');
    // }


    
    protected static function boot()
    { 
        parent::boot();
    }



}
