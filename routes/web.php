<?php

use App\Http\Controllers\FlightController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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
        Route::post('/login', 'login')->name('login.perform');
    });

    Route::get('/forget-password', function(){
        return view('auth.forget-password');
    })->name('password.request');

    Route::post('/forget-password', function(Request $request){
        $status = Password::sendResetLink($request->only('email'));
        return redirect()->back()->with("success", "Check you mail");
        // return $status === Password::RESET_LINK_SENT ? back()->with(['status' => __($status)]) : back()->withErrors(['email' => __($status)]);
    })->name('password.email');

    Route::get('/reset-password/{token}', function($token){
        return view('auth.reset-password', ['token' => $token]);
    })->name('password.reset');

    Route::post('/reset-password', function(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function($user, $password){
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
            }
        );
        return $status === Password::PASSWORD_RESET ? redirect()->route('login')->with('status', __($status)) : back()->withErrors(['email' => [__($status)]]);
    })->name('password.update');

});


Route::group(['middleware' => ['auth']], function(){
    Route::controller(LogoutController::class)->group(function(){
        Route::get('/logout', 'perform')->name('logout.perform');
    });
    Route::controller(UserController::class)->group(function(){
        Route::get('/user-list', 'index');
    });
    Route::controller(FlightController::class)->group(function(){
        // Route::get('/flights', 'index')->middleware('isAdmin');
        Route::get('/flights', 'index');
    });
});


