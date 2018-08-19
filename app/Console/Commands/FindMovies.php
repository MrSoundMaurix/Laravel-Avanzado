<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Pelicula;

class FindMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'find:movie {id : ID de la Pelicula}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *q
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() ///logica del comando
    {
        $id=$this->argument('id');
        $pelicula=Pelicula::findOrFail($id);
        echo "Pelicula encontrada ".$pelicula->titulo;
    }
}