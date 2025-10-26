<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;
use App\Models\Orders;
use App\Models\OrderItem;


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
            return redirect()->route('login.index')
                ->with('error', 'Bạn cần đăng nhập để tiếp tục thanh toán.');
        }

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Giỏ hàng trống!');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'payment_method' => 'required|in:cod,momo',
        ]);

        // Tính tổng tiền
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Nếu chọn MoMo → chuyển hướng đến MoMo
        if ($request->payment_method === 'momo') {
            session(['checkout_data' => $request->all(), 'total' => $total]);
            return $this->momo_payment($request, $total);
        }

        // Nếu chọn COD → lưu đơn hàng trực tiếp
        $order = Orders::create([
            'user_id'    => Auth::id(),
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'address'    => $request->address,
            'order_date' => now(),
            'status'     => 'pending',
        ]);

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total_price' => $item['price'] * $item['quantity'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('checkout.confirm')->with('success', 'Đặt hàng thành công!');
    }


    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function momo_payment(Request $request)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

        $orderInfo = "Thanh toán qua MoMo";
        $amount = 10000;
        $orderId = time() . "";
        $redirectUrl = route('checkout.confirm', ['payment' => 'momo']);
        $ipnUrl = route('checkout.confirm', ['payment' => 'momo']);
        $extraData = "";

        $requestId = time() . "";
        $requestType = "payWithATM";;

        $rawHash = "accessKey=" . $accessKey .
            "&amount=" . $amount .
            "&extraData=" . $extraData .
            "&ipnUrl=" . $ipnUrl .
            "&orderId=" . $orderId .
            "&orderInfo=" . $orderInfo .
            "&partnerCode=" . $partnerCode .
            "&redirectUrl=" . $redirectUrl .
            "&requestId=" . $requestId .
            "&requestType=" . $requestType;

        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = [
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        ];

        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);

        return redirect()->to($jsonResult['payUrl']);
    }

    // ✅ Trang xác nhận / Lưu đơn hàng
    public function confirm(Request $request)
    {
        $template = 'fontend.checkout.confirm';
        $cart = session()->get('cart', []);
        $productIds = array_keys($cart);
        $products = Products::whereIn('id', $productIds)->get();

        $total = 0;
        foreach ($cart as $productId => $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Nếu là kết quả trả về từ MoMo
        if ($request->has('resultCode') && $request->resultCode == 0) {
            // 🧾 Lưu đơn hàng
            $order = Orders::create([
                'user_id' => auth()->id(),
                'name' => auth()->user()->name ?? 'Khách hàng',
                'email' => auth()->user()->email ?? '',
                'phone' => auth()->user()->phone ?? '' ,
                'address' => auth()->user()->address ?? '',
                'order_date' => now(),
                'status' => 'completed',
            ]);

            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total_price' => $item['price'] * $item['quantity'],
                ]);
            }

            session()->forget('cart');

            return view('fontend.layout', compact('order', 'template'))
                ->with('success', 'Thanh toán qua MoMo thành công!');
        }

        // Nếu chỉ xác nhận đơn hàng (thanh toán tiền mặt)
        return view('fontend.layout', compact(
            'template',
            'products',
            'cart',
            'total'
        ));
    }
    
}