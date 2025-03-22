<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Blog;

class ShopController extends Controller
{
    public function __construct()
    {
        
    }

    public function index() {
        $template = 'fontend.index';
        $blog = Blog::all();
        $trendingProducts = Products::orderBy('created_at', 'desc')->take(4)->get();
        $bestSellerProducts = Products::orderBy('created_at', 'desc')->get();
        return view('fontend.layout', compact(
            'template',
            'blog',
            'trendingProducts',
            'bestSellerProducts'
        ));
    }
}