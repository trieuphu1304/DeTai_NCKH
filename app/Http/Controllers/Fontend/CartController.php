<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Products;
use App\Models\CartItem;


class CartController extends Controller
{
    public function __construct()
    {
        
    }

    public function index() {
        $template = 'fontend.cart.index';
         // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);

        // Lấy danh sách sản phẩm trong giỏ hàng
        $productIds = array_keys($cart);  // Lấy các id của sản phẩm trong giỏ hàng
        $products = Products::whereIn('id', $productIds)->get();  // Lấy các sản phẩm từ CSDL

        // Tính toán tổng số lượng và tổng giá trị
        $total = 0;
        foreach ($cart as $productId => $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('fontend.layout', compact(
            'template',
            'products',
            'cart',
            'total'
        ));
    }

    public function addCart(Request $request)
    {
        $request->validate([
            'products_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        // Lấy sản phẩm từ DB
        $product = Products::findOrFail($request->products_id);
    
        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);
    
        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        if (isset($cart[$request->products_id])) {
            // Nếu có rồi, tăng số lượng sản phẩm
            $cart[$request->products_id]['quantity'] += $request->quantity;
        } else {
            // Nếu chưa có, thêm sản phẩm vào giỏ
            $cart[$request->products_id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'image' => $product->image, // Nếu có trường ảnh
            ];
        }
    
        // Lưu giỏ hàng vào session
        session()->put('cart', $cart);
    
        // Tính toán tổng số lượng sản phẩm trong giỏ
        $totalQuantity = 0;
        foreach ($cart as $item) {
            $totalQuantity += $item['quantity'];
        }
    
        // Trả về kết quả cho AJAX
        return response()->json([
            'message' => 'Product added to cart',
            'cartCount' => $totalQuantity
        ], 200);
        
    }
    
    public function update(Request $request)
{
    $cart = session()->get('cart', []);

    // Cập nhật số lượng của sản phẩm trong giỏ hàng
    foreach ($request->cart as $item) {
        if (isset($cart[$item['product_id']])) {
            $cart[$item['product_id']]['quantity'] = $item['quantity'];
        }
    }

    // Tính toán lại tổng số sản phẩm trong giỏ hàng
    $totalQuantity = 0;
    foreach ($cart as $item) {
        $totalQuantity += $item['quantity'];
    }

    // Tính toán tổng tiền của giỏ hàng
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['quantity'] * $item['price'];
    }

    // Lưu giỏ hàng đã cập nhật vào session
    session()->put('cart', $cart);

    // Trả về dữ liệu JSON cho client
    return response()->json([
        'success' => true,
        'cartCount' => $totalQuantity,  // Tổng số sản phẩm trong giỏ
        'total' => $total,              // Tổng tiền giỏ hàng
    ]);
}
     
    public function delete(Request $request, $id)
    {
    // Lấy giỏ hàng từ session
    $cart = session()->get('cart', []);

    // Kiểm tra nếu sản phẩm tồn tại trong giỏ
    if (isset($cart[$id])) {
        // Xóa sản phẩm khỏi giỏ
        unset($cart[$id]);
        // Lưu lại giỏ hàng vào session
        session()->put('cart', $cart);
        // Hiển thị thông báo thành công
        session()->flash('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
    } else {
        // Nếu không tìm thấy sản phẩm trong giỏ
        session()->flash('error', 'Sản phẩm không tồn tại trong giỏ hàng');
    }

    // Quay lại trang giỏ hàng
    return redirect()->route('cart.index');
    }

}