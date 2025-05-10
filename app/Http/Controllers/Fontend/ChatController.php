<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class ChatController extends Controller
{
    public function index()
    {
        return view('fontend.chatbox.chat'); // Đảm bảo đường dẫn view là chính xác
    }
    public function send(Request $request)
    {
        $token = $request->token;

        if (Auth::check()) {
            // Người dùng đã đăng nhập
            $name = Auth::user()->name;
            Message::create([
                'token' => $token,
                'user_id' => Auth::id(),
                'name' => $name,
                'message' => $request->message,
                'is_admin' => false,
            ]);
        } else {
            // Khách chưa đăng nhập
            $existing = Message::where('token', $token)->first();
            if (!$existing) {
                $name = 'Khách #' . substr(md5($token), 0, 6);
                Message::create([
                    'token' => $token,
                    'user_id' => null,
                    'name' => $name,
                    'message' => $request->message,
                    'is_admin' => false,
                ]);
            } else {
                Message::create([
                    'token' => $token,
                    'user_id' => null,
                    'name' => $existing->name,
                    'message' => $request->message,
                    'is_admin' => false,
                ]);
            }
        }
          

        return response()->json(['status' => 'ok']);
    }

    public function load(Request $request)
{
    try {
        $token = $request->get('token');

        if (!$token) {
            return response()->json(['error' => 'Token is required'], 400);
        }

        $messages = Message::where('token', $token)->orderBy('created_at')->get();
        return response()->json($messages);
    } catch (\Throwable $e) {
        return response()->json([
            'error' => true,
            'message' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile()
        ], 500);
    }
}

}
