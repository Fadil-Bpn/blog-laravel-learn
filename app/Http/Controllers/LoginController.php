<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index()
    {
        return view('login', [
            'title'=>'Login'
        ]);
    }
    public function authenticate(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Ambil URL yang dimaksud setelah login
        $intendedUrl = session()->pull('url.intended', '/dashboard');

        // Cek: jika mengarah ke gambar privat, arahkan saja ke dashboard
        if (str_contains($intendedUrl, '/private-post-images')) {
            return redirect('/dashboard');
        }

        return redirect()->to($intendedUrl);
    }

    return back()->with('loginError', 'Login failed!');
}
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
