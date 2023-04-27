<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shift_userController;
use App\Http\Controllers\ShiftApiController;
use App\Http\Controllers\UserApiController;
use App\Http\Controllers\Shift_userApiController;
use App\Http\Controllers\AuthController;


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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('shift')->group(function () {
        Route::get('/list', [ShiftApiController::class, 'index']);
        Route::get('/show/{id}', [ShiftApiController::class, 'show']);
        Route::post('/store', [ShiftApiController::class, 'store']);
        Route::put('/update/{id}', [ShiftApiController::class, 'update']);
        Route::delete('/delete/{id}', [ShiftApiController::class, 'destroy']);
    });
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('shift_user')->group(function () {
        Route::get('/list', [Shift_userApiController::class, 'index']);
        Route::get('/show/{id}', [Shift_userApiController::class, 'show']);
        Route::post('/store', [Shift_userApiController::class, 'store']);
        Route::put('/update/{id}', [Shift_userApiController::class, 'update']);
        Route::delete('/delete/{id}', [Shift_userApiController::class, 'destroy']);
    });
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('user')->group(function () {
        Route::get('/list', [UserApiController::class, 'index']);
        Route::get('/show/{id}', [UserApiController::class, 'show']);
        Route::post('/store', [UserApiController::class, 'store']);
        Route::put('/update/{id}', [UserApiController::class, 'update']);
        Route::delete('/delete/{id}', [UserApiController::class, 'destroy']);
    });
});

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/login', [AuthController::class, 'authenticate'])->name('login');



