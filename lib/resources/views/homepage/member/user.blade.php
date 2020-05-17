@extends('homepage.layouts.master')

@section('content')
	<div class="container">
	<hr>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<table class="table table-bordered table-hover text-center">
					<thead>
						<tr><h1>Lịch sử mua hàng </h1></tr>
						<tr>
							<th> STT</th>
							<th> Mã đơn hàng</th>
							<th> Ngày đặt hàng</th>
							<th> Tổng tiền</th>
						</tr>
					</thead>
					<tbody>
                        @foreach($bill as $bill)
                        <tr>
                            <td></td>
                            <td>{{$bill->bill_id}}</td>
                            <td>{{$bill->created_at}}</td>
                            <td>{{$bill->bill_total}}</td>
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
