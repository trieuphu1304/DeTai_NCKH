<body>
   

    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Tổng</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                @if (isset($cart[$product->id]))
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="d-flex">
                                                    <img src="{{ asset('upload/products/' . $product->image) }}" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <p>{{ $product->name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span id="product-price-{{ $product->id }}-unit" data-price="{{ $product->price }}">
                                                ${{ number_format($product->price, 2) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="product_count" data-product-id="{{ $product->id }}">
                                                <input type="text" name="qty" id="sst_{{ $product->id }}" maxlength="12" value="{{ $cart[$product->id]['quantity'] }}" title="Quantity:" class="input-text qty" readonly>
                                                <button onclick="updateQuantity({{ $product->id }}, 'increase')" class="increase items-count" type="button">
                                                    <i class="lnr lnr-chevron-up"></i>
                                                </button>
                                                <button onclick="updateQuantity({{ $product->id }}, 'decrease')" class="reduced items-count" type="button">
                                                    <i class="lnr lnr-chevron-down"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <span id="product-price-{{ $product->id }}-total">
                                                ${{ number_format($cart[$product->id]['quantity'] * $product->price, 2) }}
                                            </span>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('cart.delete', $product->id) }}" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa san pham này?')">
                                                    <i class="bx bx-trash me-1">Xóa</i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
    
                            <tr class="bottom_button">
                                <td colspan="3">
                                    <!-- Nút Update Cart -->
                                    <a class="button" href="javascript:void(0);" onclick="updateCartFromButton()">Cập nhật giỏ hàng</a>
                                </td>
                                <td>
                                    <h5>Tiền hàng</h5>
                                </td>
                                <td>
                                    <span id="total-amount">${{ number_format($total, 2) }}</span>                                
                                </td>
                            </tr>
                            <tr class="out_button_area">
                                <td class="d-none-l">
  
                                </td>
                                <td class="">
  
                                </td>
                                <td>
                                
                                </td>
                                <td>
  
                                </td>
                                <td>
                                    <div class="checkout_btn_inner d-flex align-items-center">
                                        <a style="padding: 0px 30px;" class="gray_btn" href="{{route('category.index')}}">Tiếp tục mua sắm</a>
                                        <a class="primary-btn ml-2" href="{{route('checkout.index')}}">Thanh toán</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    
</body>

<script>
    // Hàm tăng hoặc giảm số lượng sản phẩm
    function updateQuantity(productId, action) {
        var quantityInput = document.getElementById('sst_' + productId);
        var currentQuantity = parseInt(quantityInput.value);

        // Tăng hoặc giảm số lượng
        if (action === 'increase') {
            currentQuantity++;
        } else if (action === 'decrease' && currentQuantity > 1) {
            currentQuantity--;
        }

        // Cập nhật lại số lượng trong ô input
        quantityInput.value = currentQuantity;
    }


    // Hàm cập nhật lại giá của sản phẩm trong giỏ hàng
    function updateProductPrice(productId, quantity) {
        var productPriceUnitElement = document.getElementById('product-price-' + productId + '-unit');
        var productTotalPriceElement = document.getElementById('product-price-' + productId + '-total');
        
        // Lấy đơn giá từ thuộc tính data-price
        var unitPrice = parseFloat(productPriceUnitElement.getAttribute('data-price'));

        // Tính tổng giá dựa trên số lượng
        var totalPrice = (unitPrice * quantity).toFixed(2);

        // Cập nhật tổng giá sản phẩm hiển thị
        productTotalPriceElement.textContent = "$" + totalPrice;

        // Cập nhật lại tổng tiền giỏ hàng
        updateCartTotal();
    }

    function updateCartTotal() {
        var totalAmount = 0;

        // Chỉ lấy tổng giá sản phẩm (`product-price-*`)
        var productTotalPrices = document.querySelectorAll('[id^="product-price-"][id$="-total"]');

        productTotalPrices.forEach(function (productPriceElement) {
            var productPrice = parseFloat(productPriceElement.textContent.replace('$', ''));
            totalAmount += productPrice;
        });

        // Cập nhật tổng tiền giỏ hàng
        var totalAmountElement = document.getElementById('total-amount');
        totalAmountElement.textContent = "$" + totalAmount.toFixed(2);
    }


    // Hàm để cập nhật biểu tượng giỏ hàng (số lượng sản phẩm và tổng tiền)
    function updateCartIcon(cartCount, total) {
        const cartCountElement = document.querySelector('.nav-shop__circle');
        const totalAmountElement = document.querySelector('#total-amount');

        // Cập nhật số lượng giỏ hàng
        if (cartCountElement) {
            cartCountElement.textContent = cartCount;
        }

        // Cập nhật tổng tiền giỏ hàng
        if (totalAmountElement) {
            totalAmountElement.textContent = "$" + total.toFixed(2);
        }
    }

    // Hàm để cập nhật giỏ hàng khi nhấn nút "Update Cart"
    function updateCartFromButton() {
        const quantityInputs = document.querySelectorAll('.product_count input');
        
        // Tạo một đối tượng chứa tất cả thông tin sản phẩm cần cập nhật
        const updatedCart = [];
        
        quantityInputs.forEach(input => {
            const productId = input.closest('.product_count').getAttribute('data-product-id');
            const quantity = parseInt(input.value);
            
            // Thêm thông tin sản phẩm và số lượng vào mảng
            updatedCart.push({ product_id: productId, quantity: quantity });
            updateProductPrice(productId, quantity);
        });

        // Gửi yêu cầu cập nhật giỏ hàng
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Lấy token CSRF

        fetch("{{ route('cart.update') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({ cart: updatedCart })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Cập nhật lại biểu tượng giỏ hàng với số lượng và tổng tiền mới
                updateCartIcon(data.cartCount, data.total);
                alert('Giỏ hàng đã được cập nhật!');
            } else {
                alert('Có lỗi xảy ra!');
            }
        })
        .catch(error => console.error('Error:', error));
    }

</script>



