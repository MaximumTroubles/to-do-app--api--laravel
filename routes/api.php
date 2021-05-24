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
    Route::get('/index' , [TaskController::class, 'index']);
    Route::post('/save' , [TaskController::class, 'store']);
    Route::put('/update/{id}' , [TaskController::class, 'update']);
    Route::delete('/delete/{id}' , [TaskController::class, 'destroy']);
});
