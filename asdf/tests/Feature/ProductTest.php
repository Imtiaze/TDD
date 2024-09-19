<?php


namespace Tests\Feature;

use function Pest\Laravel\postJson;



it('can list products', function () {
    getJson('/products')->assertStatus(200);
});
it('can create a product', function () {
    $data = [
        'name' => 'Product 1',
        'price' => 100
    ];
    // 201 http created
    postJson('/products/create',$data)->assertStatus(201);
});

