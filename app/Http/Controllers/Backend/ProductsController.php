<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductCategory;


class ProductsController extends Controller
{
    public function __construct()
    {
        
    }

    public function index(Request $request) {
        $perPage = $request->get('perPage', 10);
        $products = Products::with('productcategory')->paginate($perPage);
        
        $template= 'backend.products.index';

        return view('backend.layout', compact(
            'template',
            'products',
            'perPage'
        ));
    }

    public function create() {
        $productcategory = ProductCategory::all(); 
        $template = 'backend.products.create';

        return view ('backend.layout', compact(
            'template',
            'productcategory'
        ));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required',
            'price_sale' => 'nullable',
            'productcategory_id' => 'required|exists:productcategory,id', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'quantity' => 'required',
        ]);
        $products = new Products;
        $products -> name = $request ->input('name');
        $products -> price = $request ->input('price');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $image->move('upload/products/', $filename);
            $products->image = $filename;
        }
        $products->productcategory_id = $request->input('productcategory_id');
        $products -> quantity = $request ->input('quantity');
        
        $products-> save();
    
        return redirect()->route('products.index')->with('success', 'products đã được thêm thành công!');
    }

    public function edit($id) {
        $products = products::find($id);
        $productcategory = ProductCategory::all();
        $template = 'backend.products.edit';
        return view('backend.layout', compact(
            'template',
            'products',
            'productcategory'
        ));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required',
            'price_sale' => 'nullable',
            'productcategory_id' => 'required|exists:productcategory,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'quantity' => 'required',
        ]);
        $products = Products::find($id);
        $products -> name = $request ->input('name');
        $products -> price = $request ->input('price');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $image->move('upload/products/', $filename);
            $products->image = $filename;
        }
        $products->productcategory_id = $request->input('productcategory_id');
        $products -> quantity = $request ->input('quantity');

    
        $products->save();
        return redirect()->route('products.index')->with('success', 'Danh mục đã được cập nhật thành công!');
    }

    public function delete($id) {
        $products = Products::find($id);
        $products ->delete();
        return redirect()->route('products.index')->with('success', 'Tài khoản đã được xóa!');
    }

}