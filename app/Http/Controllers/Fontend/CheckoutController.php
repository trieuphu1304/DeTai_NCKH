<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;
use App\Models\Orders;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function Laravel\Prompts\clear;

class CheckoutController extends Controller
{
    public function __construct()
    {
        
    }

    public function index() {

        $template = 'fontend.checkout.index';

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
            'cart',
            'products',
            'total'
        ));
    }
    
    public function checkout(Request $request)
    {
       
        if (!Auth::check()) {
            return redirect()->route('login.index')->with('error', 'Bạn cần đăng nhập để tiếp tục.');
        }

        $cart = session()->get('cart', []); 

        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        $request->validate([
            'address' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
        ]);

        try {
            $orders = new Orders;
            $orders->user_id = Auth::id();
            $orders ->name = $request['name'];
            $orders ->email = $request['email'];
            $orders ->address = $request['address'];
            $orders -> phone = $request['phone'];
            $orders -> status = 'pending';
            $orders ->save();

            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_id' => $orders->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total_price' => $item['price'] * $item['quantity'],
                ]);
            }
            session()->forget('cart');
            
            return redirect()->route('checkout.confirm')->with('success', 'Đơn hàng của bạn đã được đặt thành công!');
        
        }
        catch (\Exception $e) {
            return ($e->getMessage()); // Hiển thị lỗi để kiểm tra
        }        

    }


    public function confirm() {
        $template = 'fontend.checkout.confirm';
        $cart = session()->get('cart', []);
    
    
        // Lấy danh sách sản phẩm trong giỏ hàng
        $productIds = array_keys($cart);
        $products = Products::whereIn('id', $productIds)->get();
    
        // Tính tổng
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
    
}