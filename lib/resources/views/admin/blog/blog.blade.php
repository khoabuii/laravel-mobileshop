@extends('admin.layout.main')
		@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Bài viết</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">

				<div class="panel panel-primary">
					<div class="panel-heading">Danh sách bài viết</div>
                    @include('noti.success')
					<div class="panel-body">
						<div class="bootstrap-table">
							<div class="table-responsive">
								<a href="{{asset('admin/blog/add')}}" class="btn btn-primary">Thêm bài viết</a>
								<table class="table table-bordered" style="margin-top:20px;">
									<thead>
										<tr class="bg-primary">
											<th>ID</th>
											<th width="25%">Tiêu đề</th>
											<th width="25%">Hình ảnh</th>
                                            <th width="25%">Tóm tắt</th>
                                            <th width="12%">view</th>
											<th width="12%">Tùy chọn</th>
										</tr>
									</thead>
									<tbody>
                                       @foreach($blogs as $blog)
										<tr>
											<td>{{$blog->blog_id}}</td>
											<td>{{$blog->blog_title}}

                                            </td>
											<td>
                                 <img width="150px" src="{{asset('lib/storage/app/blog/'.$blog->blog_img)}}" class="thumbnail" class="thumbnail">
                                            </td>

											<td>
                                                {{$blog->blog_summary}}
                                            </td>
                                            <td>
                                                {{$blog->blog_view}}
                                            </td>

											<td>
												<a href="{{asset('admin/blog/edit')}}/{{$blog->blog_id}}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>
												<a href="{{asset('admin/blog/delete')}}/{{$blog->blog_id}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
											</td>
										</tr>
                                        @endforeach
									</tbody>
								</table>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
@endsection
