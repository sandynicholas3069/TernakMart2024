<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SessionController extends Controller
{
    public function landing()
    {
        return view('landing');
    }

    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email Wajib Diisi',
            'email.email' => 'Format Email Tidak Valid',
            'password.required' => 'Password Wajib Diisi',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = Auth::user()->role;

            if ($role === 'pemilik') {
                return redirect()->route('dashboard')->with('role', 'admin');
            }

            return redirect()->route('dashboard')->with('role', 'user');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }


    public function dashboard()
    {
        $user = Auth::user();

        if ($user->role === 'pemilik') {
            return view('dashboard_admin');
        }

        return view('dashboard_user');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }
}
