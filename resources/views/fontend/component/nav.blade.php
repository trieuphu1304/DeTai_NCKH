<header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <a class="navbar-brand logo_h" href="{{ route('shop.index') }}">
            <img src="{{ asset('public/fontend/img/logo.png') }}" alt="Logo">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
              <li class="nav-item">
                <a href="{{route('shop.index')}}" class="nav-link">Trang chủ</a>
              </li>              
              <li class="nav-item">
                <a href="{{route('category.index')}}" class="nav-link">Danh mục</a>
              </li>
  
              <li class="nav-item">
                <a href="{{route('viewblog.index')}}" class="nav-link">Tin tức</a>
              </li>

              <li class="nav-item">
                <a href="{{route('contact.index')}}" class="nav-link">Liên hệ</a>
              </li>

            </ul>
            @php 
                $totalQuantity = 0; 
            @endphp

            @if(session('cart'))
                @foreach(session('cart') as $item)
                    @php 
                        $totalQuantity += $item['quantity']; 
                    @endphp
                @endforeach
            @endif

            <ul class="nav-shop">
              <li class="nav-item"><button><i class="ti-search"></i></button></li>
              <li class="nav-item">
                  <a href="{{ route('cart.index') }}" class="btn">
                      <i class="ti-shopping-cart"></i>
                      <span class="nav-shop__circle" id="cart-count">{{ $totalQuantity }}</span>
                  </a>
              </li>          
          </ul>
            <ul class="nav-shop">
              <li class="nav-item submenu dropdown">
                  <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      <i class="fa-regular fa-user"></i>
                      @auth
                          {{ Auth::user()->name }} 
                      @endauth
                  </a>
                  <ul class="dropdown-menu">
                      @guest
                          <li class="nav-item"><a class="nav-link" href="{{ route('login.index') }}">Đăng nhập</a></li>
                          <li style="margin-left:0px;" class="nav-item"><a class="nav-link" href="{{route('register.index')}}">Đăng kí</a></li>                      @endguest
                      @auth
                          <li style="margin-left:0px;" class="nav-item"><a class="nav-link" href="{{ route('authfontend.logout') }}">Đăng xuất</a></li>
                      @endauth
                  </ul>
              </li>
          </ul>
          
          </div>
        </div>  
      </nav>
    </div>
  </header>
