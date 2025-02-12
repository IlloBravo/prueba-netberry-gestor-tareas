<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/get-all-tasks', [TaskController::class, 'indexJson']);
Route::get('/', [TaskController::class, 'index']);
Route::post('/create-tasks', [TaskController::class, 'store']);
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
