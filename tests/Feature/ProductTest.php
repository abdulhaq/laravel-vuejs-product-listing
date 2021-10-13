<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function test_add_new_product()
    {
        //$product = new Product(['Test Product', '22', 'This product came from test', '%s', '%s']);
        $response = $this->post('api/product', [
            'title' => 'Test Product',
            'price' => '22',
            'body' => 'This product came from test'
        ]);
        $response->assertStatus(201);
    }
}
