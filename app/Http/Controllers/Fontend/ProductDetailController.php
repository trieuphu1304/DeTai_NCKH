<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;

class ProductDetailController extends Controller
{
    public function __construct()
    {
        
    }

    public function index($id) {
        $template = 'fontend.product.index';
        $products = Products::find($id);
        
        return view('fontend.layout',compact(
            'template',
            'products'
        ));
    }
}