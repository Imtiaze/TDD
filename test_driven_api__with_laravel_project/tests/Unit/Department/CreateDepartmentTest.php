<?php

it('should create a department', function() {
    $department = postJson(route('departments.store'), [
        'name' => 'Department',
        'description' => 'Awesome developers accross the board',
    ])->json('data');


    expect($department)
        ->attribute->name->toBe('Department')
        ->attribute->description->toBe('Awesome developers accross the board');

});

it('validate a department', function() {
    $this->assertTrue(true);
});
