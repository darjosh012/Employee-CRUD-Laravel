<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\User;
use Log;

class UsersController extends Controller
{

    public function index() {
        $users = User::all();
        return view ('pages.users', compact('users'));
    }
    
    public function userFetchTable() {
        $users = User::all();
        return view ('pages.usersTable', compact('users'));
    }
    public function store(Request $request) {
        $user = new User();
        $user->name = $request->name;
        $user->nickname= $request->nickname;
        $user->email= $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        
        return response()->json(['success' => 'all good']);
        
    }
    public function destroy(Request $request) {
        $user = new User();
        User::where('id', $request->user_id)->delete();
        return response()->json(['success' => $user->password]);
    }
    
    public function update(Request $request) {
        $validator = $request->validate ([
            'name' => 'required|max:255',
            'nickname' => 'required|max:255',
            'email' => 'required|unique:users,email,'. $request->id .'|email',
            'currentPassword' => 'required|old_password: '. User::find($request->id)->password,
            'newPassword' => 'required|min:8',
        ]);

        $user = User::find($request->id);
        $user->name = $request->name;
        $user->nickname = $request->nickname;
        $user->email = $request->email;
        $user->password = Hash::make($request->newPassword);
        $user->save();   
        return response()->json(['success' => 'done!']);   
    } 
}
