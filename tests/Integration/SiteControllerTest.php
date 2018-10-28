<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SiteControllerTest extends TestCase
{
    public function testLoadIndexPage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
