<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Pelicula;
use DB;




class PeliculaChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->buildChart();    
    }

    private function buildChart()
    {
        $peliculas = Pelicula::select('anio', DB::raw('count(*) as total'))->orderBy('anio')->groupBy('anio')->get();
        $this->dataset('Películas', 'pie', $peliculas->pluck('total'))->options([
            'borderColor'=>'red',
            'backgroundColor'=>'lightblue'
        ]);
        $this->labels($peliculas->pluck('anio'));
    }

}
