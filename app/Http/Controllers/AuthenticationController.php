<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Log;

class AuthenticationController extends Controller
{
    public function loginIndex() {
        if (Auth::check()){
             return Redirect::to('employees');
        } else {
             return view('pages.login');
        }
       
    }
    public function landing() {
        return view ('pages.landing');
    }
    public function loginProcess(Request $request) {
        $userdata = array (
            'email' => $request->email,
            'password' => $request->password
        );
        
        if (Auth::attempt($userdata)) {
            return response()->json(['success' => 'done!']);
        } else {
             return response()->json(['error' => 'sad'], 401 );
       }
    }
    public function logout() {
        Auth::logout();
        return Redirect::to('login');
    }
}
