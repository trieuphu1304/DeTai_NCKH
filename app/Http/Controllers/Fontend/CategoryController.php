<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductCategory;

class CategoryController extends Controller
{
    public function __construct()
    {
        
    }

    public function index(Request $request) {
        $template = 'fontend.category.index';
        $categoryFilter = request('category');
    
        $products = Products::when($categoryFilter, function ($query) use ($categoryFilter) {
            return $query->where('productcategory_id', $categoryFilter);  
        })->orderBy('created_at', 'desc')->get();
    
        $productcategory = ProductCategory::all();
        return view('fontend.layout', compact(
            'template', 
            'products', 
            'productcategory'
        ));
    }
}