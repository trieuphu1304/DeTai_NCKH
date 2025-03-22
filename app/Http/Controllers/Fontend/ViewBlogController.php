<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class ViewBlogController extends Controller
{
    public function __construct()
    {
        
    }

    public function index() {
        $blog = Blog::all();
        $template = 'fontend.blog.index';
        return view('fontend.layout', compact(
            'template',
            'blog'
        ));
    }
}