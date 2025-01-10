<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showSignUpForm()
{
    return view('signup');
}

public function processSignUp(Request $request)
{
    $request->validate([
        'name' => 'required|min:3|max:255|regex:/^\S.*\S$/',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|regex:/^08[0-9]{6,13}$/',
        'password' => 'required|min:8|regex:/^\S.*\S$/',
        'confirm_password' => 'required|same:password',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => bcrypt($request->password),
    ]);

    return redirect('/home');
}

}
