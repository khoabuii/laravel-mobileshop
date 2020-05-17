@extends('admin.layout.main')
@section('title','Order')
		@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Order</h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="panel panel-primary">
                <div class="panel-heading">Danh sách Đơn hàng</div>
                @include('noti.success')
                <div class="panel-body">
                    <div class="bootstrap-table">
                        <div class="table-responsive">
                            <table class="table table-striped" style="margin-top:20px;">
                                <thead>
                                    <tr id="tbl-first-row" class="bg-primary">
                                        <th>Mã đơn hàng</th>
                                        <th>Tên KH</th>
                                        <th>Email đặt hàng</th>
                                        <th>SĐT KH</th>
                                        <th>Địa chỉ</th>
                                        <th>Ghi chú</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Tùy chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order as $order)
                                    <tr>
                                        <td>{{$order->bill_id}}</td>
                                        <td>{{$order->name}}

                                        </td>
                                        <td>
                                            {{$order->email}}
                                        </td>

                                        <td>
                                            0{{$order->bill_phone}}
                                        </td>
                                        <td>
                                            {{$order->bill_address}}
                                        </td>
                                        <td>
                                            {{$order->bill_note}}
                                        </td>
                                        <td>
                                            {{number_format($order->bill_total)}} VND
                                        </td>
                                        <td>
                                            @if($order->bill_status==0)
                                                <p style="color:yellow">Đang xử lý</p>
                                            @elseif($order->bill_status==1)
                                                <p style="color:yellowgreen">Xác nhận</p>
                                            @elseif($order->bill_status==2)
                                                <p style="color:green">Đã giao</p>
                                            @else($order->bill_status==3)
                                                <p style="color:red">Đã Hủy đơn</p>
                                            @endif
                                        </td>
                                        <td>

                                            <a  target='' href="{{asset('admin/order/view')}}/{{$order->bill_id}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Xem chi tiết</a>
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
