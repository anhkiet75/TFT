<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\UserController;
use App\Models\Equipment;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home')->middleware('auth:web');

Route::get('login', [AuthController::class,'index'])->name('login');
Route::post('login', [AuthController::class,'login'])->name('loginauth');

//Route::get('/user', [UserController::class,'index'])->name('web.user.index');
//Route::put('/user/{id}', [UserController::class,'update'])->name('web.user.update');
//Route::delete('/user/{id}', [UserController::class,'destroy'])->name('web.user.delete');
Route::apiResource('user', UserController::class);
// Route::resource('category', UserController::class)->only(['index','store','destroy','update']);
// Route::apiResource('equipment', UserController::class);


Route::get('/category', [CategoryController::class,'index'])->name('web.category.index');
Route::post('/category', [CategoryController::class,'store'])->name('web.category.store');
Route::delete('/category/{category}', [CategoryController::class,'destroy'])->name('web.category.destroy');
Route::put('/category/{category}', [CategoryController::class,'update'])->name('web.category.update');

Route::get('/equipment', [EquipmentController::class,'index'])->name('web.equipment.index');


