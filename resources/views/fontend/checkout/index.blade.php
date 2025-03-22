<body>	

      <!-- ================ end banner area ================= -->
    
    
    <!--================Checkout Area =================-->
    <section class="checkout_area section-margin--small">
        <div class="container">
            <div class="returning_customer">
                
               
            </div>
            <div class="cupon_area">
              
            </div>
          <div class="billing_details">
              <div class="row">
                  <div class="col-lg-12">
                    <form method="POST" action="{{ route('checkout') }}">
                        @csrf
                        <h3>Chi tiết hóa đơn</h3>
                        <div class="order_box">
                            <h2>Đơn hàng của bạn</h2>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name ?? '' }}" required>
                                
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone number" required>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="email" name="email" value="{{ Auth::user()->email ?? '' }}">
                            </div>
                            <ul class="list">
                                @foreach($cart as $item)
                                    <li>
                                        <a href="#">{{ $item['name'] }} 
                                            <span class="middle">x {{ $item['quantity'] }}</span> 
                                            <span class="last">{{ number_format($item['price'], 2, ',', '.') }} VND</span>
                                        </a>
                                    </li>
                                @endforeach
                            
                            </ul>
                            <ul class="list list_2">
                                <li><a href="#">Tổng mặt hàng <span>{{ number_format($total, 2, ',', '.') }} VND</span></a></li>
                                <li><a href="#">Phí giao hàng <span>50.00 VND</span></a></li>
                                <li><a href="#">Tổng <span>{{ number_format($total + 50, 2, ',', '.') }} VND</span></a></li> 
                            </ul>
                            
                            <div class="text-center">
                                @if (Auth::check())
                                    <button type="submit" class="button button-paypal">Đặt hàng</button> 
                                @else
                                    <p>Vui lòng <a href="{{ route('login.index') }}">đăng nhập</a> để tiếp tục đặt hàng.</p>
                                    <a href="{{ route('login.index') }}" class="button button-login">Đăng nhập</a>
                                @endif
                                
                        </div>
                    </form>
                    </div>
                  </div>
                
              </div>
          </div>

          
      </div>
    </section>
  
  </body>