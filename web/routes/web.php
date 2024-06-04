<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
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

Route::redirect('/', '/home');
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route::group(['prefix' => 'user'], function () {
//     Route::get('/', [UserController::class, 'index'])->name('user');
//     Route::get('/create', [UserController::class, 'create'])->name('user-create');
//     Route::post('/store', [UserController::class, 'store'])->name('user-store');
// });

Route::resource('user', UserController::class);

Route::group(['prefix' => 'report'], function () {
    Route::get('/', [ReportController::class, 'index'])->name('report');
});
