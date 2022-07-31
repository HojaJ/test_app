<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;


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


Route::group(['as' => 'api.'], function(){
    Route::apiResource('users',UserController::class);
//    Route::get('users', [UserController::class, 'index'])->name('user.index');
//    Route::get('user/{id}', [UserController::class, 'show'])->name('user.show');
//    Route::post('user', [UserController::class, 'store'])->name('user.store');
});
