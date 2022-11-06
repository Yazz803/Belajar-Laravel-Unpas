<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index',[
            'title' => 'Register',
            'active' => 'register',
            'baseurl' => Controller::BASEURL
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'email' => 'required|unique:users',
            'password' => 'required|min:5|max:255'
        ]); 

        // $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
        // $flash = session()->flash('success', 'Berhasil Registrasi! Silahkan Login :)');
        // $request->$flash;
        return redirect('/login')->with('success', 'Berhasil Registrasi! Silahkan Login :)');
    }
}
