<?php

use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;

it('can list products', function() {
    getJson('/api/products')->assertStatus(200);
});

it('can create a product', function () {
    $data = [
        'name' => 'Product 1',
        'price' => 100
    ];
    // 201 http created
    postJson('/api/products/create',$data)
        ->assertStatus(201)
        ->assertJson([
            'name' => 'Product 1',
            'price' => 100
        ]);
});


it('fails to create a product without a name', function() {
    postJson('/api/products/create', ['price' => 100])
        ->assertStatus(422)
        ->assertJsonValidationErrors('name');
});