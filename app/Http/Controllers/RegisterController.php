<?php

namespace App\Http\Controllers;

use App\Events\RegisterEvent;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
   /**
     * Display register page.
     * 
     * @return \Illuminate\Http\Response
     */

     public function show(){
        return view('auth.register');
     }

     /**
     * Handle account registration request
     * 
     * @param RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */

     public function register(RegisterRequest $request){
        $user = User::create($request->validated());
        event(new RegisterEvent($request->input('email')));
        auth()->login($user);
        return redirect('/')->with('success', 'Account successfully registered');
     }
}
