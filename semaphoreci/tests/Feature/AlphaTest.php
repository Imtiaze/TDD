<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AlphaTest extends TestCase
{
    /** @test */
    public function alpha_view_display()
    {
        $response = $this->get('/alpha');

        $response->assertStatus(200);
        $response->assertSee('Alpha');
        $response->assertDontSee('Beta');
    }
}
