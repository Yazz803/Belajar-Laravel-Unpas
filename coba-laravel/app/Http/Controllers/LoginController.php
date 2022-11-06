<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'login',
            'active' => 'login',
            'baseurl' => Controller::BASEURL
        ]);
    }

    public function authenticate (Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            // mengapa kita melakukan regenerate pada session, ini untuk menghindari sebuah teknik hacking
            // yg namanya session fixation, jadi bagaimana seseorang itu masuk kedalam celah keamanan sistem 
            // menggunakan session, jadi pura2 masuk dengan session yg sama dengna sebelumnya, jadi gk perlu login lagi
            // karena dia sudah menggunakan session yg sama. Untuk menghindari ini, kita generate ulang sessionnya

            // redirect usernya ke halaman dashboard
            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Login Gagal!');

        // dd("Berhaisl Login!");
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
