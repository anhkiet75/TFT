<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function(){
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
        Route::get('user/{user}', 'test');
    });
});

Route::group(['prefix' => 'mess', 'middleware' => ['token']], function(){
    Route::controller(MessageController::class)->group(function () {
        Route::get('message', 'index');
        Route::post('message', 'store');
        Route::get('message/{id}', 'show');
        Route::put('message/{id}', 'update');
        Route::delete('message/{id}', 'destroy');
    }); 
});

