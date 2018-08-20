<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $primaryKey="idGenero";
    protected $table="generos";
    public $timestamps=true;
    public $guarded=[];
    protected $hidden=['pivot'];
    protected $fillable=['nombre','created_at','updated_at'];

    
    // public function peliculas(){
    //     return $this->belongsToMany('\App\Pelicula','peliculas_generos','idGenero','idPelicula');
    // }

}