<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('home');
// })->name('home')->middleware('auth:web');

Route::get('login', [AuthController::class,'index'])->name('index');
Route::post('login', [AuthController::class,'login'])->name('login');
Route::get('register',function() {
    return view('auth.register');
})->name('register');
Route::post('register', [AuthController::class,'register'])->name('auth.register');

Route::get('logout', [AuthController::class,'logout']);

Route::middleware(['auth:web','admin'])->group(function (){
    Route::get('/', function () {
        return view('home');
    });
    Route::get('/user', [UserController::class,'index'])->name('web.user.index');
    Route::post('/user', [UserController::class,'create'])->name('web.user.create');
    Route::put('/user/{id}', [UserController::class,'update'])->name('web.user.update');
    Route::delete('/user/{id}', [UserController::class,'destroy'])->name('web.user.delete');

    Route::get('/category', [CategoryController::class,'index'])->name('web.category.index');
    Route::post('/category', [CategoryController::class,'store'])->name('web.category.store');
    Route::delete('/category/{category}', [CategoryController::class,'destroy'])->name('web.category.destroy');
    Route::put('/category/{category}', [CategoryController::class,'update'])->name('web.category.update');

    // Route::get('/equipment', [EquipmentController::class,'index'])->name('web.equipment.index');
    Route::post('/equipment', [EquipmentController::class,'store'])->name('web.equipment.store');
    Route::delete('/equipment/{equipment}', [EquipmentController::class,'destroy'])->name('web.equipment.destroy');
    Route::patch('/equipment/{equipment}', [EquipmentController::class,'update'])->name('web.equipment.update');
});

Route::middleware(['auth:web','owner'])->get('/equipment_user/{id}', [EquipmentController::class,'show'])->name('web.equipment.show');

// test jwt , normal user can access equipment page , but cannot search equipment (call api with middleware jwt) and other action like update, delete, create.
Route::get('/equipment', [EquipmentController::class,'index'])->name('web.equipment.index')->middleware(['auth:web']);

