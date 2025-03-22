<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
       
    }

    public function admin()
    {
        if (Auth::id() > 0 ) {
            return redirect()->route('dashboard.layout');
        }
        return view('backend.login');
    }

    public function login(AuthRequest $request)
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        if (Auth::attempt($credentials)) {
            $users = Auth::user();
            if($users -> roles_id) {
                return redirect()->route('dashboard.layout');
            }
            return redirect()->route('fontend.index');
        }

        flash()->addError('Email hoặc mật khẩu không chính xác');
        return redirect()->route('auth.admin')->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.admin');
    }
}