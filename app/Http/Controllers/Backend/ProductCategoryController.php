<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    public function __construct() {

    }

    public function index() {
        $productcategory = ProductCategory::all();
        $template = 'backend.productcategory.index';

        return view('backend.layout', compact(
            'template',
            'productcategory'
        ));
    }

    public function create() {
        $template = 'backend.productcategory.create';

        return view ('backend.layout', compact(
            'template'
        ));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $productcategory = new ProductCategory;
        $productcategory -> name = $request ->input('name');
        
        $productcategory-> save();
    
        return redirect()->route('productcategory.index')->with('success', 'productcategory đã được thêm thành công!');
    }

    public function edit($id) {
        $productcategory = ProductCategory::find($id);
        $template = 'backend.productcategory.edit';
        return view('backend.layout', compact(
            'template',
            'productcategory'
        ));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $productcategory = ProductCategory::find($id);
        $productcategory -> name = $request ->input('name');

        $productcategory->save();
        return redirect()->route('productcategory.index')->with('success', 'Danh mục đã được cập nhật thành công!');
    }

    public function delete($id) {
        $productcategory = ProductCategory::find($id);
        $productcategory ->delete();
        return redirect()->route('productcategory.index')->with('success', 'Danh mục đã được xóa!');
    }

}