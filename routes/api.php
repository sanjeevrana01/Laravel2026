<?php

use App\Http\Controllers\StudentApiController;
use Illuminate\Support\Facades\Route;

Route::get('/students', [StudentApiController::class, 'index']);
Route::get('/students/{id}', [StudentApiController::class, 'show']);
Route::post('/students', [StudentApiController::class, 'store']);
Route::put('/students/{id}', [StudentApiController::class, 'update']);
Route::delete('/students/{id}', [StudentApiController::class, 'destroy']);
