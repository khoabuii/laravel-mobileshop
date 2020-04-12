@include('homepage.layouts.header')
@include('homepage.modules.menu')
	<div class="container">
	  	<div class="row">
			@yield('content')
			@include('homepage.modules.gioithieu')
	  	</div>       <!-- /row -->
	</div> <!-- /container -->
@include('homepage.layouts.footer')
