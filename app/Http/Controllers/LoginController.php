<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function doLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/dashboard');
        } else {
            $errorMessage = 'Invalid credentials, please try again.';
            return back()
                ->with('errors', $errorMessage);
        }
    }

    public function logout()
    {
        Auth::logout();
        
        return redirect('/');
    }
}
