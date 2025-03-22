<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Trang chủ /</span> Thêm sản phẩm
        </h4>
        
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <!-- Hiển thị lỗi nếu có -->
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
                        <h5 class="mb-0">Thêm sản phẩm</h5>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="products-name">Tên sản phẩm</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input 
                                        type="text" 
                                        id="products-name" 
                                        name="name" 
                                        class="form-control" 
                                        placeholder="Nhập tên products" 
                                        value="{{ old('name') }}" 
                                        required
                                    >
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="products-description">Mô tả</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-comment"></i></span>
                                    <textarea 
                                        id="products-description" 
                                        name="description" 
                                        class="form-control" 
                                        placeholder="Nhập mô tả products"
                                        rows="3"
                                    >{{ old('description') }}</textarea>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="categorySelect" class="form-label">Danh mục sản phẩm</label>
                                <select id="categorySelect" name="productcategory_id" class="form-select form-select-lg">
                                    <option value="">Chọn danh mục</option>
                                    @foreach($productcategory as $productcategory)
                                        <option value="{{ $productcategory->id }}">{{ $productcategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">$</span>
                                    <input name="price" type="text" class="form-control" placeholder="100" aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-text">.00</span>
                                  </div>
                            </div>

                            <div class="mb-3">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">$</span>
                                    <input name="price_sale" type="text" class="form-control" placeholder="100" aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-text">.00</span>
                                  </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="products-image">Ảnh</label>
                                <div class="input-group">
                                    <input 
                                        type="file" 
                                        id="products-image" 
                                        name="image" 
                                        class="form-control" 
                                        accept="image/*"
                                    >
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="html5-number-input" class="col-md-2 col-form-label">Số lượng</label>
                                <div class="col-md-10">
                                  <input name="quantity" type="number" id="html5-number-input">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>     
</div>
