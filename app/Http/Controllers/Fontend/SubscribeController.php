<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function store(Request $request)
    {
        // Kiểm tra tính hợp lệ của email
        $request->validate([
            'email' => 'required|email|unique:subscribes,email',
        ]);

        // Lưu email vào cơ sở dữ liệu
        Subscribe::create([
            'email' => $request->email,
        ]);

        // Trả về phản hồi dưới dạng JSON
        return response()->json(['message' => 'Đăng ký thành công!']);
    }
}
