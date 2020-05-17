@include('homepage.layouts.header')
@include('homepage.modules.menu')
	@include('homepage.modules.slide')
    <div class="container">
      	<div class="row">
            @yield('content')
            @yield('script')
			@include('homepage.modules.gioithieu')
      	</div>       <!-- /row -->
    </div> <!-- /container -->
@include('homepage.layouts.footer')
