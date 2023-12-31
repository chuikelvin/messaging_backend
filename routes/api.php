<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::post('/login', [UserController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/customerIds', [MessageController::class, 'getCustomers']);
    Route::get('/messages/{user_id}', [MessageController::class, 'getMessages']);
    Route::post('/message', [MessageController::class, 'sendMessage']);
    Route::post('/logout', [UserController::class, 'logout']);
});





Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    return $request->user();
});
