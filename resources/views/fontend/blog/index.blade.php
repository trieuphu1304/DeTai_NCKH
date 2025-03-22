

    <section class="blog_categorie_area">
      <div class="container">
        <div class="row">
            @foreach($blog as $blog)
                <div class="col-sm-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="categories_post">
                        
                        <img class="card-img rounded-0" src="{{ asset('upload/blog/' . $blog->image) }}">
                        <div class="categories_details">
                            <div class="categories_text">
                                <a href="single-blog.html">
                                    <h5>Tin tức mới</h5>
                                </a>
                                <div class="border_line"></div>
                                <p>Tận hưởng những phút giây mua sắm tuyệt vời</p>
                            </div>
                        </div>
                        
                    </div>
                </div>  
            @endforeach  
        </div>
      </div>
    </section>
    <!--================Blog Categorie Area =================-->
  
    <!--================Blog Area =================-->
    <section class="blog_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog_left_sidebar">
                        <article class="row blog_item">
                            <div class="col-md-3">
                                <div class="blog_info text-right">
                                    <div class="post_tag">
                                        <a href="#">Đồ ăn,</a>
                                        <a class="active" href="#">Công nghệ,</a>
                                        <a href="#">Chính sách,</a>
                                        <a href="#">Phong cách</a>
                                    </div>
                                    <ul class="blog_meta list">
                                        <li>
                                            <a href="#">Triệu phú
                                                <i class="lnr lnr-user"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">Tháng 2, 2025
                                                <i class="lnr lnr-calendar-full"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">1.2M Views
                                                <i class="lnr lnr-eye"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">06 Bình luận
                                                <i class="lnr lnr-bubble"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="blog_post">
                                    <img src="img/blog/main-blog/m-blog-1.jpg" alt="">
                                    <div class="blog_details">
                                        <a href="single-blog.html">
                                            <h2>Sản phẩm tuyệt vời là cốt lõi của bán hàng</h2>
                                        </a>
                                        <p>Luôn quan tâm đến trải nghiệm người dùng và lợi ích của khách hàng</p>
                                        <a class="button button-blog" href="#">Xem thêm</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="row blog_item">
                            <div class="col-md-3">
                                <div class="blog_info text-right">
                                    <div class="post_tag">
                                       
                                    </div>
                                    <ul class="blog_meta list">
                                        
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="blog_post">
                                    
                                    <div class="blog_details">
                                        
                                        </div>
                                </div>
                            </div>
                        </article>
                       
                        
                        
                        <nav class="blog-pagination justify-content-center d-flex">
                            
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Tìm kiếm bài viết">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="lnr lnr-magnifier"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                            <div class="br"></div>
                        </aside>
                        <aside class="single_sidebar_widget author_widget">
                            <img class="author_img rounded-circle" src="img/blog/author.png" alt="">
                            <h4>Triệu phú</h4>
                            <p>Chuyên gia đánh giá</p>
                            <div class="social_icon">
                                <a href="#">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#">
                                    <i class="fab fa-github"></i>
                                </a>
                                <a href="#">
                                  <i class="fab fa-behance"></i>
                                </a>
                            </div>
                            <p>
                            </p>
                            <div class="br"></div>
                        </aside>
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
  
    <!--================Instagram Area =================-->
    <section class="instagram_area">
      <div class="container box_1620">
        <div class="insta_btn">
          <a class="btn theme_btn" href="#">Theo dõi chúng tôi</a>
        </div>
        <div class="instagram_image row m0">
          <a href="#"><img src="img/instagram/ins-1.jpg" alt=""></a>
          <a href="#"><img src="img/instagram/ins-2.jpg" alt=""></a>
          <a href="#"><img src="img/instagram/ins-3.jpg" alt=""></a>
          <a href="#"><img src="img/instagram/ins-4.jpg" alt=""></a>
          <a href="#"><img src="img/instagram/ins-5.jpg" alt=""></a>
          <a href="#"><img src="img/instagram/ins-6.jpg" alt=""></a>
        </div>
      </div>
    </section>