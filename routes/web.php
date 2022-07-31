<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\GiftBoxController;
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

Route::redirect('/', 'dashboard');

Route::group(['middleware' => 'auth:admin'], function(){
    Route::get('/dashboard', function() { return view('dashboard.dashboard'); })->name('dashboard');
    Route::resource('/admin_user', AdminController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/gift_box', GiftBoxController::class);
    Route::resource('/gift', GiftController::class);

    Route::post('give_to_user', [GiftController::class, 'giveToUser'])->name('gift.give_to_user');
    Route::post('give_to_user_box', [GiftBoxController::class, 'giveToUser'])->name('gift_box.give_to_user');
    Route::post('add_to_box', [GiftController::class, 'addToBox'])->name('gift.add_to_box');
});

require __DIR__.'/auth.php';
