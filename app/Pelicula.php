<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Storage;
use Illuminate\Support\Facades\Auth;
use Input;
use App\Notifications\PeliculaNotification;

class Pelicula extends Model
{
    protected $primaryKey="idPelicula";
    protected $table="peliculas";
    public $timestamps=true;
    public $fillable = ['titulo', 'duracion', 'anio', 'imagen', 'idUser']; 
    protected $hidden=['pivot'];
    //CONST created_at='fecha_registro';
    //CONST updated_at='fecha_modificacion';
    
    public function usuario()
    {
        return $this->belongsTo('\App\User', 'idUser');
    }


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

        static::deleted(function ($pelicula) { // before delete() method call this
            $pelicula->peliculas()->detach();
            if($pelicula->imagen != null){
                Storage::delete($pelicula->imagen);
                $user = Auth::user();
                $user->notify(new PeliculaNotification($pelicula));

            }

        });
        static::deleting(function ($pelicula) { // before delete() method call this
            $pelicula->generos()->detach();
            if ($pelicula->imagen != null) {
                Storage::delete($pelicula->imagen);
            }
        });

        static::creating(function ($pelicula) {
            $pelicula->idUser = Auth::id();
            if (Input::hasFile('imagen') && $pelicula->imagen != null) {
                $image = Input::file('imagen');
                $pelicula->imagen = $image->store('public/peliculas');
            }
        });


        // static::deleted(function ($pelicula) {
        //     $user = Auth::user();
        //     $user->notify(new PeliculaNotification($pelicula));
        // }); 
        // static::created(function ($pelicula) {
        //     if (Input::hasFile('imagen') && $pelicula->imagen != null) {
        //         $image = Input::file('imagen');
        //         $pelicula->imagen = $image->store('public/peliculas');
        //         $user = Auth::user();
        //         $user->notify(new PeliculaNotification($peliculea,true,true));
        //     }
        // });

    }


}