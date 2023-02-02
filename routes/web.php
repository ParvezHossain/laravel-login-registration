<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use Illuminate\Routing\Router;
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
Route::controller(HomeController::class)->group(function(){
    Route::get('/', 'index');
});

Route::group(['middleware' => ['guest']], function(){
    Route::controller(RegisterController::class)->group(function(){
        Route::get('/register', 'show')->name('register.show');
        Route::post('/register', 'register')->name('register.perform');
    });
    Route::controller(LoginController::class)->group(function(){
        Route::get('/login', 'show')->name('login.show');
        Route::post('login', 'login')->name('login.perform');
    });
});


Route::group(['middleware' => ['auth']], function(){
    Route::controller(LogoutController::class)->group(function(){
        Route::get('/logout', 'perform')->name('logout.perform');
    });
});
