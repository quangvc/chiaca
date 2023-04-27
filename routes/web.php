<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\Shift_userController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
})->name('welcome');

Route::post('/login', [AuthController::class, 'authenticate1'])->name('login');
Route::get('/logout', [AuthController::class, 'logout1'])->name('logout');



Route::prefix('shift')->group(function () {
    Route::get('/list', [ShiftController::class, 'index'])->name('shift.list');
    Route::get('/create', [ShiftController::class, 'create'])->name('shift.create');
    Route::post('/store', [ShiftController::class, 'store'])->name('shift.store');
    Route::get('/edit/{id}', [ShiftController::class, 'edit'])->name('shift.edit');
    Route::post('/update/{id}', [ShiftController::class, 'update'])->name('shift.update');
    Route::get('/detele/{id}', [ShiftController::class, 'destroy'])->name('shift.delete');
});

Route::prefix('user')->group(function () {
    Route::get('/list', [UserController::class, 'index'])->name('user.list');
    Route::get('/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/detele/{id}', [UserController::class, 'destroy'])->name('user.delete');
});


Route::middleware('auth')->prefix('shift_user')->group(function () {
    Route::get('/list', [Shift_userController::class, 'index'])->name('shift_user.list');
    Route::get('/create', [Shift_userController::class, 'create'])->name('shift_user.create');
    Route::post('/store', [Shift_userController::class, 'store'])->name('shift_user.store');
    Route::get('/edit/{id}', [Shift_userController::class, 'edit'])->name('shift_user.edit');
    Route::post('/update/{id}', [Shift_userController::class, 'update'])->name('shift_user.update');
    Route::get('/detele/{id}', [Shift_userController::class, 'destroy'])->name('shift_user.delete');
});

Route::get('/swagger', function () {
    return redirect('/swagger-ui/dist/index.html');
});