<!DOCTYPE html>
<html lang="en">
<head>
  @include('fontend.component.head')
</head>
<body>
  <!--================ Start Header Menu Area =================-->
	@include('fontend.component.nav')
	<!--================ End Header Menu Area =================-->

  <main class="site-main">
    @include($template)
  </main>


  <!--================ Start footer Area  =================-->	
  @include('fontend.component.footer')
	<!--================ End footer Area  =================-->

  @include('fontend.component.script')

</body>
</html>