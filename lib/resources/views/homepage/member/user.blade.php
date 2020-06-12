@extends('homepage.layouts.master')
@section('title','Thông tin tài khoản')
@section('content')
	<div class="container">
	<hr>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<table class="table table-bordered table-hover text-center">
					<thead>
						<tr><h1>Lịch sử mua hàng </h1></tr>
						<tr>

							<th> Mã đơn hàng</th>
							<th> Ngày đặt hàng</th>
                            <th> Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Hủy đơn</th>
						</tr>
					</thead>
					<tbody>
                        @foreach($bill as $bill)
                        <tr>

                            <td>{{$bill->bill_id}}</td>
                            <td>{{$bill->created_at}}</td>
                            <td>{{number_format($bill->bill_total)}} VND</td>
                            <td>
                                @if($bill->bill_status==0)
                                    <p style="color:yellow">Đang xử lý</p>
                                @elseif($bill->bill_status==1)
                                    <p style="color:yellowgreen">Xác nhận</p>
                                @elseif($bill->bill_status==2)
                                    <p style="color:green">Xác nhận</p>
                                @else
                                    <p style="color:red">Đã hủy</p>
                                @endif

                            </td>
                            <td>
                                @if($bill->bill_status==0)
                                <a href="{{url('/cancelbill/'.$bill->bill_id)}}" class="close .bg-danger" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
					</tbody>
				</table>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="table-responsive">
					<table class="table table-bordered table-hover text-center">
						<thead>
							<tr>
                                @include('noti.success')
								<th colspan="2"> Thông tin khách hàng : {!!Auth::user()->name !!} (<a href="user/edit">Sửa thông tin</a>)</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Họ tên</td>
								<td>{!!Auth::user()->name!!}</td>
							</tr>
							<tr>
								<td>Địa chỉ E-mail</td>
								<td>{!!Auth::user()->email!!}</td>
							</tr>
							<tr>
								<td>Điện thoại</td>
								<td>{!!Auth::user()->numberPhone !!}</td>
							</tr>
							<tr>
								<td>Địa chỉ Khách hàng</td>
								<td>{!!Auth::user()->address!!}</td>
							</tr>
							<tr>
								<td>Ngày đăng ký</td>
								<td>{!!Auth::user()->created_at !!}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
