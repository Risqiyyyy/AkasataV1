<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginBasic extends Controller
{
  public function index()
  {
      if (Auth::check()) {
        return redirect()->route('dashboard-analytics');
    }
    return view('content.authentications.auth-login-basic');
  }

  public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/Dashboard');
        }

        return redirect()->route('Login.auth')->with('error', 'Invalid credentials.');
    }

    public function logout(Request $request)
    {
      Auth::logout();

      $request->session()->invalidate();

      $request->session()->regenerateToken();

      return redirect('/');
    }
}
