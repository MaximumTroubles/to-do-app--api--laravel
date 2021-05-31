<?php

use App\Http\Controllers\Task\TaskController;
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
