<?php

use App\Http\Controllers\Task\TaskController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('task')->group(function () {
    Route::get('/' , [TaskController::class, 'index']);
    Route::get('/done' , [TaskController::class, 'taskDone']);
    Route::post('/' , [TaskController::class, 'store']);
    Route::put('/{id}' , [TaskController::class, 'update']);
    Route::delete('/{id}' , [TaskController::class, 'destroy']);
});

Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'getAll']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});
