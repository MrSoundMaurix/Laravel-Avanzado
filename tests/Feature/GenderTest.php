<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GenderTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testEstructure()
    {
        $response=$this->json('GET','/api/gender/1');
        $response->assertSuccessful();
        // $response->assertJsonStructure(
        //     ['nombre','updaed_at']);
    }
}
