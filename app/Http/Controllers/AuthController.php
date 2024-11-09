<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Str;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.authentication.register');
    }
    public function registration(Request $request)
    {
        // dd($request->all());
        $user = request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6|confirmed',
            // 'confirm_password' => 'required_with:password|same:password|min:6',
        ]);

        $user           = new User;
        $user->name     = trim($request->name);
        $user->email    = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->usertype = 'user';
        $user->remember_token = Str::random(50);
        $user->save();
        return redirect('/login')->with('success', 'User Registration Successfully');
    }

    public function create()
    {
        return view('admin.authentication.login');
    }
    public function login(Request $request)
    {
        // dd($request->all());
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password ], true))
        {
            // Check if the user is authenticated and has a user_type_id
            if (Auth::check() && Auth::user()->usertype == 'admin') {
                return redirect()->route('dashboard');
            } else {
                // If authenticated but no user_type_id, handle accordingly
                return redirect()->route('login')->with('error', 'User type not found.');
            }
        } else {
            // Authentication failed, redirect back with error message
            return redirect()->back()->with('error', 'Incorrect credentials. Please try again.');
        }
    }

    public function forgot()
    {
        return view('backend.auth.forgot_password');
    }
}
