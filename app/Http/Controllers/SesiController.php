<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    
    function index()
    {
        return view('login');
    }

    function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Email tidak valid',
                'password.required' => 'Password wajib diisi',
            ]
        );

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            if (Auth::user()->role == 'superadmin') {
                return redirect('/superadmin');
            } elseif (Auth::user()->role == 'admin') {
                return redirect('/admin');
            } else {
                return redirect('/sales');
            }
        } else {
            return redirect('')->withErrors('Email atau password salah')->withInput();
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('');
    }
}
