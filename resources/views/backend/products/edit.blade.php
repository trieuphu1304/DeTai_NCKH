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
                        <h5 class="mb-0">Cập nhật sản phẩm<h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('products.update', $products ->id) }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="name">Tên</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input name="name" type="text" class="form-control" value="{{$products ->name}}"
                                        id="name" placeholder="Tên" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="products-description">Mô tả</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-comment"></i></span>
                                    <textarea 
                                        value ="{{$products ->description}}"
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
                                    @foreach($productcategory as $category)
                                        <option value="{{ $category->id }}" 
                                            {{ $category->id == $products->productcategory_id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="mb-3">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">$</span>
                                    <input value="{{ $products ->price}}" name="price" type="text" class="form-control" placeholder="100" aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-text">.00</span>
                                  </div>
                            </div>

                            <div class="mb-3">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">$</span>
                                    <input value="{{ $products ->price_sale}}" name="price_sale" type="text" class="form-control" placeholder="100" aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-text">.00</span>
                                  </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="products-image">Ảnh</label>
                                <div class="input-group">
                                    <input 
                                        value ="{{$products ->image}}"
                                        type="file" 
                                        id="products-image" 
                                        name="image" 
                                        class="form-control" 
                                        accept="image/*"
                                    >
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="html5-number-input" class="col-md-2 col-form-label">Number</label>
                                <div class="col-md-10">
                                  <input name="quantity" type="number" value="{{ $products ->quantity}}" id="html5-number-input">
                                </div>
                            </div>
                           
                            <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>