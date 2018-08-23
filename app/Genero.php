<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\GeneroNotification;
use OneSignal;

class Genero extends Model
{

    use SoftDeletes;

    protected $primaryKey="idGenero";
    protected $table="generos";
    public $timestamps=true;

    protected $fillable = ['nombre','imagen'];
    protected $hidden = ['pivot']; ///cuando existe una relacion de muchos a muchos 

    protected $dates = ['deleted_at'];

    public function peliculas(){
        return $this->belongsToMany('\App\Pelicula', 'peliculas_generos','idGenero', 'idPelicula');
    }

     protected static function boot()
    {
        parent::boot();

        static::deleted(function ($genero) {
            $route=route("generos.show",$genero->idGenero);
            OneSignal::sendNotificationToAll("Se envio a papelera el genero".$genero->nombre."a las ".$genero->deleted_at."++++>".$route);
            $user = Auth::user();
            $user->notify(new GeneroNotification($genero));
        });
        static::created(function ($genero) {
            $user = Auth::user();
            $user->notify(new GeneroNotification($genero,true,true));
        });

    }




    // protected $primaryKey="idGenero";
    // protected $table="generos";
    // public $timestamps=true;
    // public $guarded=[];
    // protected $hidden=['pivot'];
    // protected $fillable=['nombre','created_at','updated_at'];

    
    // public function peliculas(){
    //     return $this->belongsToMany('\App\Pelicula','peliculas_generos','idGenero','idPelicula');
    // }

}