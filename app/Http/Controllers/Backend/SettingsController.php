<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User; 

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('backend.settings.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
    
        // Validate name & email
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);
    
        $user->name = $request->name;
        $user->email = $request->email;
    
        // Xử lý avatar nếu có upload
        if ($request->hasFile('avatar')) {
            // Xóa ảnh cũ nếu có
            if ($user->avatar) {
                \Storage::disk('public')->delete($user->avatar);
            }
    
            // Lưu ảnh mới vào storage/app/public/avatars
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }
    
        $user->save();
    
        session()->flash('success', 'Thông tin cá nhân đã được cập nhật thành công!');
        return redirect()->route('settings.index');
    }
    

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed'],
        ]);

        Auth::user()->update(['password' => Hash::make($request->password)]);
        // Trong Controller
        session()->flash('success', 'Thông báo thành công!');


        return redirect()->route('settings.index');
    }
}