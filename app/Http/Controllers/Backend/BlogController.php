<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;
use App\Models\Blog;

class BlogController extends Controller
{
    public function __construct()
    {
        
    }

    public function index() {
        $blog = Blog::all();
        $template = 'backend.blog.index';

        return view('backend.layout', compact(
            'template',
            'blog'
        ));
    }

    public function create() {
        $template = 'backend.blog.create';

        return view ('backend.layout', compact(
            'template'
        ));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $blog = new Blog;
        $blog -> name = $request ->input('name');
        $blog -> description = $request ->input('description');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $image->move('upload/blog/', $filename);
            $blog->image = $filename;
        }
        
        $blog-> save();
    
        return redirect()->route('blog.index')->with('success', 'Blog đã được thêm thành công!');
    }

    public function edit($id) {
        $blog = Blog::find($id);
        $template = 'backend.blog.edit';
        return view('backend.layout', compact(
            'template',
            'blog'
        ));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $blog = Blog::find($id);
        $blog -> name = $request ->input('name');
        $blog -> description = $request ->input('description');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $image->move('upload/blog/', $filename);
            $blog->image = $filename;
        }
    
        $blog->save();
        return redirect()->route('blog.index')->with('success', 'Danh mục đã được cập nhật thành công!');
    }

    public function delete($id) {
        $blog = Blog::find($id);
        $blog ->delete();
        return redirect()->route('blog.index')->with('success', 'Danh mục đã được xóa!');
    }
}