<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {

        $response = $this->get('api/metas');

        $response->assertOk();
    }

    /** @test */
    public function usersTest()
    {
        $response = $this->get('/en/api/informations');

        $response->assertOk();
    }
}
