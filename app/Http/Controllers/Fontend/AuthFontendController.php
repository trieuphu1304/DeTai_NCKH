<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthFontendRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthFontendController extends Controller
{
    
    public function index()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('shop.index');
        }

        $template = 'fontend.user.login.index';
        return view('fontend.layout', compact('template'));
    }

    public function login(AuthFontendRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('shop.index')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng.',
        ])->withInput();
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login.index')->with('success', 'Đăng xuất thành công!');
    }
}