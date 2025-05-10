<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function __construct()
    {
        
    }

    public function index() {
        $template = 'fontend.contact.index';

        return view('fontend.layout', compact(
            'template'
        ));
    }
    public function sendContact(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Lưu vào database
        Contact::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->route('contact.index')->with('success', 'Cảm ơn bạn đã liên hệ, chúng tôi sẽ phản hồi sớm!');
    }
}