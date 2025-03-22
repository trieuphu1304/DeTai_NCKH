<body>
	@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	
	<!-- ================ end banner area ================= -->
  
  <!--================Login Box Area =================-->
	<section class="login_box_area section-margin">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<div class="hover">
							<h4>Bạn đã có tài khoản ?</h4>
							<a class="button button-account" href="{{route('login.index')}}">Đăng nhập ngay</a>
						</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="login_form_inner register_form_inner">
						<h3>Đăng kí</h3>
						<form method="POST" class="row login_form" action="{{ route('register')}}" id="register_form">
                            @csrf
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="name" name="name" placeholder="Tên người dùng" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
							</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="email" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'">
                            </div>
                            <div class="col-md-12 form-group">
								<input type="text" class="form-control" id="password" name="password" placeholder="Mật khẩu" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                            </div>
                            
							<div class="col-md-12 form-group">
								
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="button button-register w-100">Đăng kí</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->



  
</body>