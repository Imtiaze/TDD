<?php

use App\Http\Controllers\DepartmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('departments', [DepartmentController::class, 'index'])->name('departments.index');
Route::get('departments/{department}', [DepartmentController::class, 'show'])->name('departments.show');
Route::post('departments', [DepartmentController::class, 'store'])->name('departments.store');
Route::put('departments/{department}', [DepartmentController::class, 'update'])->name('departments.update');