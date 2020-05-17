@extends('admin.layout.main')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Trang chủ</h1>
		</div>
	</div><!--/.row-->

	<div class="row">
		<div class="col-xs-12 col-md-6 col-lg-3">
			<div class="panel panel-blue panel-widget ">
				<div class="row no-padding">
					<div class="col-sm-3 col-lg-5 widget-left">
						<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
					</div>
					<div class="col-sm-9 col-lg-7 widget-right">
						<div class="large">{{$prod_count}}</div>
						<div class="text-muted">Sản phẩm</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-6 col-lg-3">
			<div class="panel panel-orange panel-widget">
				<div class="row no-padding">
					<div class="col-sm-3 col-lg-5 widget-left">
						<svg class="glyph stroked empty-message"><use xlink:href="#stroked-empty-message"></use></svg>
					</div>
					<div class="col-sm-9 col-lg-7 widget-right">
						<div class="large">{{$com_count}}</div>
						<div class="text-muted">Bình luận</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-6 col-lg-3">
			<div class="panel panel-teal panel-widget">
				<div class="row no-padding">
					<div class="col-sm-3 col-lg-5 widget-left">
						<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
					</div>
					<div class="col-sm-9 col-lg-7 widget-right">
						<div class="large">{{$count_users}}</div>
						<div class="text-muted">Người dùng</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-6 col-lg-3">
			<div class="panel panel-red panel-widget">
				<div class="row no-padding">
					<div class="col-sm-3 col-lg-5 widget-left">
						<svg class="glyph stroked app-window-with-content"><use xlink:href="#stroked-app-window-with-content"></use></svg>
					</div>
					<div class="col-sm-9 col-lg-7 widget-right">
						<div class="large">{{$count_blog}}</div>
						<div class="text-muted">Bài viết</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-6 col-lg-3">
			<div class="panel panel-teal panel-widget">
				<div class="row no-padding">
					<div class="col-sm-3 col-lg-5 widget-left">
						<svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg>						</div>
					<div class="col-sm-9 col-lg-7 widget-right">
						<div class="large">{{count($order)}} </div>
						<div class="text-muted">Đơn hàng</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-6 col-lg-3">
			<div class="panel panel-teal panel-widget">
				<div class="row no-padding">
					<div class="col-sm-3 col-lg-5 widget-left">
					<svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg>
					</div>
					<div class="col-sm-9 col-lg-7 widget-right">
						<div class="large">{{$count_cate}}</div>
						<div class="text-muted">Loại sản phẩm</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-6 col-lg-3">
			<div class="panel panel-teal panel-widget">
				<div class="row no-padding">
					<div class="col-sm-3 col-lg-5 widget-left">
					<svg class="glyph stroked email"><use xlink:href="#stroked-email"/></svg>

					</div>
					<div class="col-sm-9 col-lg-7 widget-right">
						<div class="large">11</div>
						<div class="text-muted">Feedback</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-6 col-lg-3">
			<div class="panel panel-teal panel-widget">
				<div class="row no-padding">
					<div class="col-sm-3 col-lg-5 widget-left">
					<svg class="glyph stroked monitor"><use xlink:href="#stroked-monitor"/></svg>

					</div>
					<div class="col-sm-9 col-lg-7 widget-right">
						<div class="large">{{$count_slide}}</div>
						<div class="text-muted">Slide</div>
					</div>
				</div>
			</div>
		</div>
	</div><!--/.row-->

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-red">
				<div class="panel-heading dark-overlay"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg>Lịch</div>
				<div class="panel-body">
					<div id="calendar"></div>
				</div>
			</div>
		</div><!--/.col-->
	</div><!--/.row-->
</div>	<!--/.main-->
@endsection
