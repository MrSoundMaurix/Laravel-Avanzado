<?php

namespace App\Exports;

use App\Genero;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class GenerosExport implements FromCollection,WithHeadings,WithTitle,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Genero::all();
    }

    public function headings():array{

        return[
            'ID',
            'Nombre',
            'Correo',
            'Fecha de Creación',
            'Última Actualización',
        ];
    }

    public function title():string{
        return 'Usuarioss';
    }
}
