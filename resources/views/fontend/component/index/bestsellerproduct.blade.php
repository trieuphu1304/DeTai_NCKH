<section class="section-margin calc-60px">
    <div class="container">
      <div class="section-intro pb-60px">
        <p>Sản phẩm thịnh hành</p>
        <h2>Sản phẩm <span class="section-intro__style">bán chạy</span></h2>
      </div>
      <div class="row">
        @foreach ($bestSellerProducts as $products)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card text-center card-product">
                    <!-- Hình ảnh sản phẩm -->
                    <div class="card-product__img">
                        <img class="img-fluid" src="{{ asset('upload/products/' . $products->image) }}" alt="{{ $products->name }}">
                        <ul class="card-product__imgOverlay">
                            <li><button><i class="ti-search"></i></button></li>
                            <li><button class="add-to-cart_1" data-product-id="{{ $products->id }}"><i class="ti-shopping-cart"></i></button></li>
                            <li><button><i class="ti-heart"></i></button></li>
                        </ul>
                    </div>
                    <!-- Nội dung sản phẩm -->
                    <div class="card-body">
                        <h4 class="card-product__title"><a href="{{ route('productdetail.index', ['id' => $products->id]) }}">{{ $products->name }}</a></h4>
                        <p class="card-product__price">${{ number_format($products->price, 2) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    </div>
</section>

<script>
    // Lắng nghe sự kiện khi nhấn vào nút "Add to Cart"
    document.querySelectorAll('.add-to-cart_1').forEach(function(button) {
        button.addEventListener('click', function() {
            var productId = this.getAttribute('data-product-id');
            var quantity = 1;  // Mặc định là 1 sản phẩm khi nhấn thêm vào giỏ hàng

            // Gửi yêu cầu AJAX để thêm sản phẩm vào giỏ hàng
            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    'products_id': productId,
                    'quantity': quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                // Thông báo thành công với SweetAlert2
                Swal.fire({
                    icon: 'success',
                    title: 'Đã thêm sản phẩm vào giỏ!',
                    timer: 2000, // 2 giây tự động đóng thông báo
                    showConfirmButton: false // Không hiển thị nút "OK"
                });

                // Cập nhật số lượng giỏ hàng
                document.querySelector('.nav-shop__circle').textContent = data.cartCount; // Cập nhật số lượng giỏ hàng
            })
            .catch(error => {
                console.error('Error:', error);

                // Thông báo lỗi với SweetAlert2
                Swal.fire({
                    icon: 'error',
                    title: 'Có lỗi xảy ra!',
                    text: 'Vui lòng thử lại sau.'
                });
            });
        });
    });
</script>
