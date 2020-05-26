@extends('admin.layout.main')
@section('title','Sản phẩm')
		@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Sản phẩm</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">

				<div class="panel panel-primary">
					<div class="panel-heading">Danh sách sản phẩm</div>
                    @include('noti.success')
					<div class="panel-body">
						<div class="bootstrap-table">
							<div class="table-responsive">
								<a href="{{asset('admin/product/add')}}" class="btn btn-primary">Thêm sản phẩm</a>
								<table class="table table-bordered" style="margin-top:20px;">
									<thead>
										<tr class="bg-primary">
											<th>ID</th>
											<th width="25%">Tên Sản phẩm</th>
											<th width="17%">Giá bán chính thức</th>
                                            <th width="10%">Trạng thái</th>
                                            <th width="12%">Tình trạng</th>
                                            <th>Danh mục</th>
                                            <th>Nổi bật</th>
											<th width="12%">Tùy chọn</th>
										</tr>
									</thead>
									<tbody>
                                        @foreach($product as $prod)
										<tr>
											<td>{{$prod->prod_id}}</td>
											<td>{{$prod->prod_name}}
                                            <img width="150px" src="{{asset('lib/storage/app/avatar/'.$prod->prod_img)}}" class="thumbnail" class="thumbnail">
                                            </td>
											<td>
                                                @if($prod->prod_promotion_price)
                                                {{number_format($prod->prod_promotion_price,0,',','.')}}VND
                                                @else
                                                {{number_format($prod->prod_price,0,',','.')}}VND
                                                @endif
                                            </td>

											<td>
                                                @if(($prod->prod_status)==1)
                                                Còn hàng
                                                @else
                                                Hết hàng
                                                @endif
                                            </td>
                                            <td>
                                                {{$prod->prod_condition}}
                                            </td>
                                            <td>{{$prod->cate_name}}</td>
                                            <td>
                                                @if($prod->prod_feature==1)
                                                Có
                                                @else
                                                Không
                                                @endif
                                            </td>
											<td>
												<a href="{{asset('admin/product/edit')}}/{{$prod->prod_id}}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>
												<a href="{{asset('admin/product/delete')}}/{{$prod->prod_id}}"  onclick="return confirm('Chắc không?')" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
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
