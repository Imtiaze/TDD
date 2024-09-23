<?php

use App\Models\Department;

use function Pest\Laravel\putJson;


it('should return 422 and a validation error if name is invalid', function(?string $name) {
    $department = Department::factory([
        'name' => 'development',
    ])->create();

    putJson(route('departments.update', compact('department')), [
        'name' => $name,
        'description' => 'description'
    ])->assertStatus(422)
    ->assertInvalid(['name']); 

})->with([
    '',
    null
]);


it('should update a department with', function(string $name, string $description) {

    $department = Department::factory([
        'name' => 'development',
        'description' => 'description'
    ])->create();

    putJson(route('departments.update', compact('department')), [
        'name' => $name,
        'description' => $description
    ])->assertNoContent();

    expect(Department::find($department->id))
        ->name->toBe($name)
        ->description->toBe($description);

})->with([
    ['name' => 'development', 'desription' => 'description'],
    ['name' => 'new development', 'description' => 'new description']
]);


it('should return a validation error if department name is not unique during update', function() {

    $department = Department::factory([
        'name' => 'development',
    ])->create();

    Department::factory([
        'name' => 'development2'
    ])->create();
    

    putJson(route('departments.update', compact('department')), [
        'name' => 'development2',
        'description' => 'description'
    ])->assertStatus(422)
    ->assertJsonValidationErrors(['name']);
});
