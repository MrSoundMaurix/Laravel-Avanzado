<?php

namespace App\Exports;

use App\Pelicula;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PeliculaTittleExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        $tittle= Pelicula::orderBy('titulo')->get(['titulo']);
        $sheets = [];

        foreach ($tittle as $y) {
            $sheets[] = new PeliculaPerTittleSheet($y->tittle);
        }
        return $sheets;
    }
}
