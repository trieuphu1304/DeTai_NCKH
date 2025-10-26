<body>


    <!-- ================ end banner area ================= -->

    <!--================Order Details Area =================-->
    <section class="order_details section-margin--small">
        <div class="container">
            <p class="text-center billing-alert">Cảm ơn, đơn hàng của bạn đã đặt thành công</p>

            <!-- Thêm ảnh ở giữa và dưới dòng cảm ơn -->
            <div class="text-center" data-aos="zoom-in" data-aos-duration="800" style="margin-top:20px;">
                <img src="{{ asset('/fontend/comfirm.jpeg') }}" alt="Cảm ơn"
                    style="max-width:260px; width:100%; height:auto; display:inline-block;">
            </div>

            <div class="row mb-5">
                <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">

                </div>
                <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">

                </div>
                <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">

                </div>
            </div>


            <div class="table-responsive">


            </div>
            <div class="checkout_btn_inner d-flex align-items-center">
                <a style="padding: 0px 41px; margin-top: 30px; margin-left: auto;" class="gray_btn"
                    href="{{ route('category.index') }}">Tiếp tục mua sắm</a>
            </div>


        </div>
    </section>

</body>
