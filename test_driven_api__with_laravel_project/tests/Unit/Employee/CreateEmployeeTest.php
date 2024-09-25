<?php

use App\Models\Department;
use App\Models\Employee;

use function Pest\Laravel\postJson;

it('should return 422 if email is invalid', function(?string $email) {

    Employee::factory([
        'email' => 'taken@example.com'
    ])->create();

    postJson(route('employees.store'), [
        'full_name' => 'Test Employee',
        'email' =>  $email,
        'department_id' => Department::factory()->create()->uuid,
        'job_title' => 'Be Developer',
        'payment_type' => 'salary',
        'salary' => 75000 * 100
    ])->assertInvalid();
})->with([
    'taken@example.com',
    'invalid',
    null,
    ''
]);

it('should return 422 if payment type is invalid', function() {
    
    postJson(route('employees.store'), [
        'full_name' => 'Test Employee',
        'email' => 'test@example.com',
        'department_id' => Department::factory()->create()->uuid,
        'job_title' => 'Be Developer',
        'payment_type' => 'invalid',
        'salary' => 75000 * 100
    ])->assertInvalid();
});

it('should return 422 if salary or hourly_rate is missing', function(string $paymentType, ?int $salary, ?int $hourlyRate) {
    
    postJson(route('employees.store'), [
        'full_name' => 'Test Employee',
        'email' => 'test@example.com',
        'department_id' => Department::factory()->create()->uuid,
        'job_title' => 'Be Developer',
        'payment_type' => $paymentType,
        'salary' => $salary,
        'hourly_rate' => $hourlyRate
    ])->assertInvalid();
    
})->with([
    ['payment_type' => 'salary', 'salary' => null, 'hourly_rate' => 30 * 100],
    ['payment_type' => 'salary', 'salary' => 0, 'hourly_rate' => null],
    ['payment_type' => 'hourly_rate', 'salary' => 75000 * 100, 'hourly_rate' => null],
    ['payment_type' => 'hourly_rate', 'salary' => null, 'hourly_rate' => 0],
]);
