<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    //
    protected $primaryKey="idActor";
    protected $table="actores";
    public $timestamps=true;

    protected $fillable = ['nombres','apellidos'];
    protected $hidden = ['pivot']; ///cuando existe una relacion de muchos a muchos 

    protected $dates = ['deleted_at'];

    public function peliculas()
    {
        return $this->belongsToMany('\App\Pelicula', 'peliculas_actores', 'idActor', 'idPelicula');
    }


    

}
