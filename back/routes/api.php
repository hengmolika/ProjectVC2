<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClassController;


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);


Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('students', [StudentController::class, 'index']);
    Route::get('students/{id}', [StudentController::class, 'show']);
    Route::post('students', [StudentController::class, 'store']);
    Route::put('students/{id}', [StudentController::class, 'update']);
    Route::delete('students/{id}', [StudentController::class, 'destroy']);
// Get class Route 
    Route::get('class',[ClassController::class, 'getClass']);

    Route::put('users/{id}', [UserController::class, 'update']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);

    Route::post('logout', [UserController::class, 'logout']);
    
});