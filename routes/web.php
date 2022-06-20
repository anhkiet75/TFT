<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\UserController;
use App\Models\Equipment;
use Illuminate\Support\Facades\Auth;

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

Route::get('index', [AuthController::class,'index'])->name('index');
Route::get('register',function() {
    return view('auth.register');
})->name('register');
Route::post('login', [AuthController::class,'login'])->name('login');
Route::get('logout', [AuthController::class,'logout']);
Route::post('register', [AuthController::class,'register'])->name('auth.register');

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
    
    Route::get('/equipment', [EquipmentController::class,'index'])->name('web.equipment.index');
    Route::post('/equipment', [EquipmentController::class,'store'])->name('web.equipment.store');
    Route::delete('/equipment/{equipment}', [EquipmentController::class,'destroy'])->name('web.equipment.destroy');
    Route::patch('/equipment/{equipment}', [EquipmentController::class,'update'])->name('web.equipment.update');
});

Route::middleware(['auth:web','owner'])->get('/equipment_user/{id}', [EquipmentController::class,'show'])->name('web.equipment.show');






// Route::apiResource('user', UserController::class);
// Route::resource('category', UserController::class)->only(['index','store','destroy','update']);
// Route::apiResource('equipment', UserController::class);





// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
