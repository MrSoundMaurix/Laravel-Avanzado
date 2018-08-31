<?php

namespace App\Exports;

use App\Pelicula;
use App\Genero;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class PeliculaPerTittleSheet implements FromCollection,WithHeadings,WithTitle,ShouldAutoSize,WithMapping
{
    private $tittle;
    public function __construct($tittle){
        $this->tittle=$tittle;
    }
    

    public function map($pelicula):array{
        return [
        $pelicula->idPelicula,
        $pelicula->duracion,
        ];
    }



    public function collection()
    {
        $genero=Genero::all();
        return Pelicula::where('titulo',$genero)
        ->get(['titulo']);
    }

    public function headings():array{

        return[
            'ID',
            'Duración',
            'Generos',
        ];
    }

    public function title():string{
        return 'Titulo '.$this->tittle;
    }

    
}
