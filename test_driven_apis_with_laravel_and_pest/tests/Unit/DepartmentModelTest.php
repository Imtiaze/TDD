<?php


use function Pest\Laravel\postJson;

it('should create a department', function () {

    $department = postJson(route('departments.store'), [
        'name' => 'Development',
        'description' => 'Awesome developers across the board!',
    ])->json('data');

    expect($department)
        ->attributes->name->toBe('Development')
        ->attributes->description->toBe('Description');

});

