<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MovieTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response=$this->json('GET','/api/movie/1');
        $response->assertSuccessful();
        $response->assertJson([
            'idPelicula'=>1,
            'idUser'=>1,
            ]);
    }

    public function testEstructure()
    {
        $response=$this->json('GET','/api/movie/1');
        $response->assertSuccessful();
        $response->assertJsonStructure(
            ['idPelicula','titulo','duracion','anio','idUser',]);
    }

}
