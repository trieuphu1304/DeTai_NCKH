<section class="blog">
    <div class="container">
      <div class="section-intro pb-60px">
        <p>Tin tức mới nhất</p>
        <h2>Tin tức <span class="section-intro__style">mới</span></h2>
      </div>

      <div class="row">
            @foreach($blog as $blog)
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="card card-blog">
                        <div class="card-blog__img">
                        <img src="{{ asset('upload/blog/' .$blog->image)}}">
                        </div>
                        <div class="card-body">
                        <ul class="card-blog__info">
                            <li><a href="#">Bởi Admin</a></li>
                            <li><a href="#"><i class="ti-comments-smiley"></i> 2 Bình luận</a></li>
                        </ul>
                        <p>{{ $blog->name }}</p>
                        <p>{{ $blog->description }}</p>
                        <a class="card-blog__link" href="#">Xem thêm <i class="ti-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
      </div>
    </div>
  </section>