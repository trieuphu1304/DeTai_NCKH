<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Trang chủ /</span> Đơn hàng</h4>

    <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
            <tr>
              <th><input type="checkbox" value="" id="checkAll" class="input-checkbox"></th>
              <th>Tên khách hàng</th>
              <th>Email</th>
              <th>Ngày đặt hàng</th>
              <th>Trạng thái</th>
            </tr>
          </thead>
          <tbody class="table-borders-bottom-0">
            @if(isset($orders) && is_object($orders))
                @foreach($orders as $orders)
                    <tr>
                        <td><input type="checkbox" value="{{ $orders->id }}" class="input-checkbox checked-item"></td>
                        <td>{{ $orders->name }}</td>
                        <td>{{ $orders->email }}</td>
                        <td>{{ \Carbon\Carbon::parse($orders->order_date)->format('d/m/Y') }}</td>
                        <td>{{ ucfirst($orders->status) }}</td>
                        <td>
                            <a href="{{route('orders.edit', $orders->id)}}" class="btn btn-success"><i class="bx bx-edit-alt me-1"></i> </a>
                            <form method="POST" action="{{route('orders.delete', $orders    ->id)}}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">
                                    <i class="bx bx-trash me-1"></i> 
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
          </tbody>
        </table>
    </div>
</div>

