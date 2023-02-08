<?php

namespace App\Http\Controllers;

use App\Events\UserSubscribe;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index (){
        return view('newsletter.index');
    }

    public function subscribe(Request $request){
        $request->validate([
            'email' => 'required|unique:newsletter,email',
        ]);

        event(new UserSubscribe($request->input('email')));
        return back();
    }
}
