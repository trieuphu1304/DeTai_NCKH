<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        
    }
    public function index() {
        $users = User::all();

        $template = 'backend.users.index';
        return view('backend.layout', compact(
            'template',
            'users'
        ));
    }

    public function create() {

        $template = 'backend.users.create';
        return view('backend.layout', compact(
            'template'
        ));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
            'roles_id' => 'required|boolean', 
        ]);
        $users = new User;
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->password = Hash::make($request->input('password')); 
        $users->roles_id = $request->input('roles_id');
        $users->save();
       
        return redirect()->route('users.index')->with('success', 'Tài khoản đã được thêm thành công!');
    }

    public function edit($id) {
        $users = User::find($id);
        $template = 'backend.users.edit';
        return view('backend.layout', compact(
            'template',
            'users'
        ));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . $id,
            'password' => 'nullable|string',
            'roles_id' => 'required|boolean',
        ]);
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->roles_id = $request->input('roles_id');
    
        $user->save();
        return redirect()->route('users.index')->with('success', 'Tài khoản đã được cập nhật thành công!');
    }

    public function delete($id) {
        $users = User::find($id);
        $users ->delete();
        return redirect()->route('users.index')->with('success', 'Tài khoản đã được xóa!');
    }
}