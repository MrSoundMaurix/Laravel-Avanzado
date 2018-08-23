<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    //
    protected $primaryKey="idActor";
    protected $table="actores";
    public $timestamps=true;

    protected $fillable = ['nombreActor','ApellidoActor','imagen'];
    protected $hidden = ['pivot']; ///cuando existe una relacion de muchos a muchos 

    protected $dates = ['deleted_at'];



    

}
