<main class="site-main">

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!--================ Hero banner start =================-->
    <section class="hero-banner" data-aos="fade-up" data-aos-duration="1000">
        <div class="container">
            <div class="row no-gutters align-items-center pt-60px">
                <div class="col-5 d-none d-sm-block">
                    <div class="hero-banner__img">
                        <img class="img-fluid" src="/fontend/img/home/hero-banner.png" alt="" data-aos="zoom-in"
                            data-aos-duration="900" data-aos-delay="200">
                    </div>
                </div>
                <div class="col-sm-7 col-lg-6 offset-lg-1 pl-4 pl-md-5 pl-lg-0">
                    <div class="hero-banner__content">
                        <h4 data-aos="fade-right" data-aos-duration="800">Vui vẻ mua sắm</h4>
                        <h1 data-aos="fade-left" data-aos-duration="800" data-aos-delay="150">Sản phẩm tuyệt vời và vô
                            vàn khuyến mãi</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Hero banner end =================-->

    <!-- ================ Trending Product Section Start =================-->
    @include('fontend.component.index.trendingproducts')
    <!-- ================ Trending Product Section End =================-->

    <!-- ================ Offer Section Start =================-->
    <section class="offer" id="parallax-1" data-anchor-target="#parallax-1"
        data-300-top="background-position: 20px 30px" data-top-bottom="background-position: 0 20px" data-aos="fade-up"
        data-aos-duration="900" data-aos-delay="100">
        <div class="container">
            <div class="row">
                <div class="col-xl-5">
                    <div class="offer__content text-center">
                        <h3 data-aos="flip-left" data-aos-duration="800">Khuyến mãi 50%</h3>
                        <h4 data-aos="flip-right" data-aos-duration="800">Tuần lễ vàng</h4>
                        <a class="button button--active mt-3 mt-xl-4" href="{{ route('category.index') }}"
                            data-aos="zoom-in" data-aos-duration="700">Mua ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ Offer Section End =================-->

    <!-- ================ Best Selling Item Carousel =================-->
    @include('fontend.component.index.bestsellerproduct')
    <!-- ================ Best Selling Item Carousel End =================-->

    <!-- ================ Blog Section Start =================-->
    @include('fontend.component.index.blog')
    <!-- ================ Blog Section End =================-->

    <!-- ================ Subscribe Section Start =================-->
    <section class="subscribe-position" data-aos="fade-up" data-aos-duration="900" data-aos-delay="100">
        <div class="container">
            <div class="subscribe text-center">
                <h3 class="subscribe__title" data-aos="fade-in" data-aos-duration="700">Nhận thông báo mới nhất</h3>
                <div id="mc_embed_signup">
                    <form class="subscribe-form form-inline mt-5 pt-1" method="POST"
                        action="{{ route('subscribe.store') }}">
                        @csrf
                        <div class="form-group ml-sm-auto">
                            <input class ="form-control mb-1" type="email" name="email" id="email"
                                placeholder="Nhập Email" required data-aos="fade-up" data-aos-duration="600">
                            <div class="info"></div>
                        </div>
                        <button class="button button-subscribe mr-auto mb-1" type="submit" data-aos="flip-up"
                            data-aos-duration="600">Đăng ký ngay</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ Subscribe Section End =================-->

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Initialize AOS -->
    <script>
        AOS.init({
            once: true, // chỉ chạy 1 lần khi cuộn
            easing: 'ease-in-out',
            duration: 800
        });
    </script>

    <!-- Subscribe Form AJAX Script -->
    <script>
        $(document).ready(function() {
            $('.subscribe-form').submit(function(e) {
                e.preventDefault(); // Ngăn submit mặc định

                var email = $('#email').val();
                var token = $('meta[name="csrf-token"]').attr('content');

                if (!email) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops!',
                        text: 'Vui lòng nhập email hợp lệ!'
                    });
                    return;
                }

                $.ajax({
                    url: '{{ route('subscribe.store') }}',
                    method: 'POST',
                    data: {
                        _token: token,
                        email: email
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Đăng ký thành công!',
                            text: 'Bạn đã là một phần của chúng tôi!',
                            timer: 3000,
                            showConfirmButton: false
                        });

                        $('#email').val(''); // Reset input
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: 'Có lỗi xảy ra. Vui lòng thử lại sau.'
                        });
                        console.log("Error: ", xhr, status, error);
                    }
                });
            });
        });
    </script>


</main>
