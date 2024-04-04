<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AttendanceController;
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


Route::group(
    ['prefix' => 'auth'],
    function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);

        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::get('/me', [AuthController::class, 'me']);
            Route::get('/logout', [AuthController::class, 'logout']);
        });
    }
);

Route::group(
    [
        'middleware' => ['auth:sanctum'],
        'prefix' => 'attendance'
    ],
    function () {
        Route::get('/profile', function (Request $request) {
            return auth()->user();
        });

        Route::get('/',  [AttendanceController::class, 'index']);
        Route::post('/', [AttendanceController::class, 'create']);
    }
);
