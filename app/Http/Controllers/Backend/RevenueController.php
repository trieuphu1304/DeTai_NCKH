<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class RevenueController extends Controller
{
    public function index(Request $request)
    {
        $template = 'backend.revenue.index';

        // Xác định khoảng thời gian cần thống kê (mặc định là tháng hiện tại)
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->toDateString());

        // Lấy dữ liệu doanh số theo ngày
        $revenues = DB::table('orders')
            ->join('orderitem', 'orders.id', '=', 'orderitem.order_id')
            ->selectRaw('DATE(orders.created_at) as date, SUM(orderitem.price * orderitem.quantity) as revenue')
            ->where('orders.status', 'completed')
            ->whereBetween('orders.created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return view('backend.layout', compact(
            'template',
            'startDate',
            'endDate',
            'revenues'
        ));
    }
}