<body>
	
	@if (session('success'))
		<div class="alert alert-success">
			{{ session('success') }}
		</div>
	@endif

	@if ($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				<p>{{ $error }}</p>
			@endforeach
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
							<h4>Trở thành thành viên của chúng tôi ?</h4>
							<a class="button button-account" href="{{route('register.index')}}">Đăng kí ngay</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Đăng nhập</h3>
						<form method="POST" class="row login_form" action="{{route('authfontend.login')}}" id="contactForm">
							@csrf
              <div class="col-md-12 form-group">
								<input type="text" class="form-control" id="name" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
							</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="name" name="password" placeholder="Mật khẩu" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
							</div>
							<div class="col-md-12 form-group">
								
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="button button-login w-100">Đăng nhập</button>
								<a href="#">Quên mật khẩu ?</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>