@include('homepage.layouts.header')
@include('homepage.modules.menu')
	@include('homepage.modules.slide')
    <div class="container">
      	<div class="row">
			@yield('content')
			@include('homepage.modules.gioithieu')
      	</div>       <!-- /row -->
    </div> <!-- /container -->
@include('homepage.layouts.footer')
