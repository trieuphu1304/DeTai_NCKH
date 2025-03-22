<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Trang chủ/</span> Cập nhật sản phẩm</h4>

        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Cập nhật đơn hàng<h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('orders.update', $orders->id) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên khách hàng</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $orders->name) }}" required>
                            </div>
                    
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $orders->email) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="order_date" class="form-label">Ngày đặt hàng</label>
                                <input type="order_date" class="form-control" id="order_date" name="order_date" value="{{ old('order_date', $orders->order_date) }}" required>
                            </div>
                    
                            <div class="mb-3">
                                <label for="status" class="form-label">Trạng thái</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="pending" {{ $orders->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                    <option value="processing" {{ $orders->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                                    <option value="completed" {{ $orders->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                    <option value="canceled" {{ $orders->status == 'canceled' ? 'selected' : '' }}>Hủy bỏ</option>
                                </select>
                            </div>
                    
                            <button type="submit" class="btn btn-primary">Cập nhật đơn hàng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>