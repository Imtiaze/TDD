<?php

use function Pest\Laravel\postJson;

it('should create a department', function() {
    $department = postJson(route('departments.store'), [
        'name' => 'asdfasdf',
        'description' => 'Awesome developers accross the board',
    ])->json('data');

    expect($department)
        ->attributes->name->toBe('asdfasdf')
        ->attributes->description->toBe('Awesome developers accross the board');
    
});

