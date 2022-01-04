<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ReasonController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\Discipline_typeController;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);



Route::group(['middleware' => ['auth:sanctum']], function() {
    //--------------------------- STUDENT ROUTE -----------------------------
    Route::get('students', [StudentController::class, 'index']);
    Route::get('students/{id}', [StudentController::class, 'show']);
    Route::post('students', [StudentController::class, 'store']);
    Route::put('students/{id}', [StudentController::class, 'update']);
    Route::delete('students/{id}', [StudentController::class, 'destroy']);
    //-------------------------- ROUTE OF CLASS -----------------------------
    Route::get('/class', [ClassController::class, 'getClass']);
    // ------------------------- ROUTE PERMISSION ----------------------------
    Route::get('permissions', [PermissionController::class, 'index']);
    Route::post('permissions', [PermissionController::class, 'store']);
    Route::get('permissions/{id}', [PermissionController::class, 'show']);
    Route::put('permissions/{id}', [PermissionController::class, 'update']);
    Route::delete('permissions/{id}', [PermissionController::class, 'destroy']);
    //---------------------- GET REASON ROUTE --------------------------------
    Route::get('/reasons', [ReasonController::class, 'getReason']);
    //---------------------- ROTE DISCIPLINE -------------------------------
    Route::get('disciplines', [DisciplineController::class, 'index']);
    Route::post('disciplines', [DisciplineController::class, 'store']);
    Route::get('disciplines/{id}', [DisciplineController::class, 'show']);
    Route::put('disciplines/{id}', [DisciplineController::class, 'update']);
    Route::delete('disciplines/{id}', [DisciplineController::class, 'destroy']);
    //---------------------- GET DISCIPLINE ROUTE --------------------------------
    Route::get('/discipline_type', [Discipline_typeController::class, 'getDiscipline']);

    Route::put('users/{id}', [UserController::class, 'update']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);
    
    Route::post('logout', [UserController::class, 'logout']);
    
});