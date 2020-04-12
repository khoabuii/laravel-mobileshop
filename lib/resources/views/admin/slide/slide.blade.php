@extends('admin.layout.main')
		@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Slide</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">

				<div class="panel panel-primary">
					<div class="panel-heading">Danh sách Slide</div>
                    @include('noti.success')
					<div class="panel-body">
						<div class="bootstrap-table">
							<div class="table-responsive">
								<a href="{{asset('admin/slide/add')}}" class="btn btn-primary">Thêm Slide</a>
								<table class="table table-bordered" style="margin-top:20px;">
									<thead>
										<tr class="bg-primary">
											<th>ID</th>
											<th width="15%">Tên slide</th>
											<th width="32%">Hình ảnh</th>
                                            <th width="30%">Link</th>
                                            <th width="8%">Trạng thái</th>
											<th width="22%">Tùy chọn</th>
										</tr>
									</thead>
									<tbody>
                                       @foreach($slides as $slide)
										<tr>
											<td>{{$slide->slide_id}}</td>
											<td>{{$slide->slide_name}}

                                            </td>
											<td>
                                 <img width="150px" src="{{asset('lib/storage/app/slide/'.$slide->slide_img)}}" class="thumbnail" class="thumbnail">
                                            </td>

											<td>
                                                {{$slide->slide_link}}
                                            </td>
                                            <td>
                                                @if($slide->status==1)
                                                Hiện
                                                @else
                                                Ẩn
                                                @endif
                                            </td>

											<td>
												<a href="{{asset('admin/slide/edit')}}/{{$slide->slide_id}}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>
												<a href="{{asset('admin/slide/delete')}}/{{$slide->slide_id}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
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
