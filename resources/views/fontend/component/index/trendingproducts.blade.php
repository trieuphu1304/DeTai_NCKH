<div class="container">
    <h2 class="fw-bold py-3 mb-4">Sản phẩm nổi bật</h2>
    <div class="row">
        @foreach($trendingProducts as $products)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card text-center card-product">
                    <!-- Hình ảnh sản phẩm -->
                    <div class="card-product__img">
                        <img class="img-fluid" src="{{ asset('upload/products/' . $products->image) }}" alt="{{ $products->name }}">
                        <ul class="card-product__imgOverlay">
                            <li><button><i class="ti-search"></i></button></li>
                            <li><button class="add-to-cart" data-product-id="{{ $products->id }}"><i class="ti-shopping-cart"></i></button></li>
                            <li><button><i class="ti-heart"></i></button></li>
                        </ul>
                    </div>
                    <!-- Nội dung sản phẩm -->
                    <div class="card-body">
                        <h4 class="card-product__title"><a href="">{{ $products->name }}</a></h4>
                        <p class="card-product__price">${{ number_format($products->price, 2) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
</div>
<script>
    // Lắng nghe sự kiện khi nhấn vào nút "Add to Cart"
    document.querySelectorAll('.add-to-cart').forEach(function(button) {
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
          // Cập nhật giỏ hàng và hiển thị thông báo thành công
          
          document.querySelector('.nav-shop__circle').textContent = data.cartCount; // Cập nhật số lượng giỏ hàng
        })
        .catch(error => {
          console.error('Error:', error);
        });
      });
    });
  </script>
  
