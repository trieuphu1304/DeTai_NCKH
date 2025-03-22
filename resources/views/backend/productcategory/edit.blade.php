<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Trang chủ/</span> Cập nhật danh mục</h4>

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
                        <h5 class="mb-0">Cập nhật danh mục<h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('productcategory.update', $productcategory ->id) }}">
                            @csrf
                         
                            <div class="mb-3">
                                <label class="form-label" for="name">Tên</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input name="name" type="text" class="form-control" value="{{$productcategory ->name}}"
                                        id="name" placeholder="Tên" required>
                                </div>
                            </div>
                           
                            <button type="submit" class="btn btn-primary">Cập nhật danh mục</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>