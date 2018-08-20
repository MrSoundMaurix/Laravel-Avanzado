<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Pelicula extends Model
{
    protected $primaryKey="idPelicula";
    protected $table="peliculas";
    public $timestamps=true;
    public $guarded=[];
    protected $hidden=['pivot'];
    //CONST created_at='fecha_registro';
    //CONST updated_at='fecha_modificacion';
    
    
    public function scopeCortas($query){
    return $query->where('duracion','<','120');

    }

    public function scopeActuales($query){
        return $query->where('anio',date('Y'));
    }
    public function scopeAgrupar($query){
    return $query->select('anio','duracion',DB::raw('count(*) as registros'))->groupBy('anio','duracion');

    }

    public function generos(){
        return $this->belongsToMany('\App\Genero','peliculas_generos','idPelicula','idGenero');
    }

    
    public static function findGenero($array, $idGenero)
    {
        foreach ($array as $item) {
            foreach ($item as $value) {
                if ($value == $idGenero) {
                    return true;
                }
            }
        }
        return false;
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($pelicula) { // before delete() method call this
            $pelicula->generos()->detach();
        });
    }

}