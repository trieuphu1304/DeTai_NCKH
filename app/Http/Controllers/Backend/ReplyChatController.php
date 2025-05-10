<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReplyChatController extends Controller
{
    /**
     * Hiển thị danh sách các cuộc trò chuyện.
     */
    public function index()
    {
        $template = 'backend.replychat.index';
        // Lấy danh sách các cuộc trò chuyện
        $conversations = Message::query()
            ->select('token', 'name', 
                \DB::raw('MAX(created_at) as last_message_at'), 
                \DB::raw('COUNT(CASE WHEN status = "pending" AND is_admin = 0 THEN 1 END) as unread_count')
            )
            ->where('name', '!=', 'Admin') // Lọc tin nhắn không phải của admin
            ->groupBy('token', 'name')
            ->orderByDesc('last_message_at')
            ->get();

        return view('backend.layout', compact('conversations', 'template'));
    }

    /**
     * Hiển thị chi tiết cuộc trò chuyện theo token.
     */
    public function show($token)
    {
        $template = 'backend.replychat.index';

        // Đánh dấu tin nhắn của người dùng là đã xem
        Message::where('token', $token)
            ->where('is_admin', 0)
            ->where('status', 'pending')
            ->update(['status' => 'seen']);

        // Lấy danh sách tin nhắn
        $messages = Message::where('token', $token)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('backend.layout', compact('token', 'template', 'messages'));
    }

    /**
     * API tải tin nhắn theo token.
     */
    public function load(Request $request)
    {
        try {
            $token = $request->get('token'); // Gán giá trị cho $token

            if (!$token) {
                return response()->json(['success' => false, 'error' => 'Token không hợp lệ'], 400);
            }
            
            $messages = Message::where('token', $token)
                ->orderBy('created_at', 'asc')
                ->get() 
                ->map(function ($msg) {
                return [
                    'name' => $msg->is_admin ? 'Admin' : ($msg->name ?? 'Người dùng'),
                    'message' => $msg->message,
                    'is_admin' => $msg->is_admin,
                ];
            });

            return response()->json(['success' => true, 'messages' => $messages]);
        } catch (\Exception $e) {
            Log::error('Error loading messages', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json(['success' => false, 'error' => 'Đã xảy ra lỗi khi tải tin nhắn'], 500);
        }
    }

    /**
     * API trả lời tin nhắn.
     */
    public function reply(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'message' => 'required|string',
        ]);

        try {
            Message::create([
                'token' => $request->token,
                'name' => 'Admin',
                'message' => $request->message,
                'is_admin' => true,
                'status' => 'replied',
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error replying to message', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'request_data' => $request->all(),
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Đã xảy ra lỗi khi trả lời tin nhắn.',
            ], 500);
        }
    }

    public function markAsSeen(Request $request)
    {
        $token = $request->input('token');

        if (!$token) {
            return response()->json(['success' => false, 'error' => 'Thiếu token'], 400);
        }

        try {
            Message::where('token', $token)
                ->where('is_admin', 0)
                ->where('status', 'pending')
                ->update(['status' => 'seen']);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error('Không thể cập nhật trạng thái tin nhắn:', ['message' => $e->getMessage()]);
            return response()->json(['success' => false, 'error' => 'Lỗi khi cập nhật trạng thái'], 500);
        }
    }

}
