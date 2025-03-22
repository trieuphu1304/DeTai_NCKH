<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        
    }

    public function index() {

        $template = 'fontend.user.register.index';
        return view('fontend.layout', compact(
            'template'
        ));
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email', // Kiểm tra email đã tồn tại
            'password' => 'required|string', 
        ], [
            'name.required' => 'Tên không được để trống.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã có người sử dụng.',
            'password.required' => 'Mật khẩu không được để trống.',
        ]);
    
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
    
        return redirect()->route('login.index')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }
    
}