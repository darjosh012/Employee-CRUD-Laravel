<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Log;

class AuthenticationController extends Controller
{
    public function loginIndex() {
        return view('pages.login');
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
        Log::debug('test');
        return Redirect::to('login');
    }
}
