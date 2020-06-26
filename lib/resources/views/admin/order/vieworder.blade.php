@extends('admin.layout.main')
@section('title','Order')

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Mã Đơn hàng: {{$bill->bill_id}}</h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="panel panel-primary">
                <div class="panel-heading">Chi tiết đơn hàng</div>
                @include('noti.success')
                <div class="panel-body">
                    <div class="bootstrap-table">

                        <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <!-- <th>Hình ảnh</th> -->
                                <th>Tên sản phẩm</th>
                                <th>SL</th>
                                <th>Giá</th>
                                <th>Thành tiền</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bill_detail as $detail)
                            <tr>
                                <td>{{$detail->detail_id}}</td>

                                <td>{{$detail->prod_name}}</td>
                                <td class="text-center">
                                    {{$detail->quantity}}
                                </td>

                                <td>
                                    {{number_format($detail->prod_price)}} VND
                            </td>
                                <td>
                                    {{number_format($detail->prod_price * $detail->quantity)}} VND
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="3"><strong>Tổng cộng :</strong> Có: {{count($bill_detail)}} sản phẩm </td>
                                <td></td>
                                <td colspan="2" style="color:red;">{{number_format($bill->bill_total)}} VND</td>
                            </tr>
                            </tbody>
                            @if($bill->bill_status==0)
                                <p style="color:yellow">Đang xử lý</p>
                            @elseif($bill->bill_status==1)
                                <p style="color:yellowgreen">Đang giao hàng</p>
                            @elseif($bill->bill_status==2)
                                <p style="color:green">Đã giao</p>
                            @else($bill->bill_status==3)
                                <p style="color:red">Đã Hủy đơn</p>
                            @endif
                        </table>
                        <b>Thời gian đặt hàng:</b> <i> {{$bill->created_at}} </i>
                        @if(($bill->bill_status ==0) || ($bill->bill_status ==1))
                            <form action="" method="post">
                                {{csrf_field()}}
                                <tr>
                                    <td>
                                    <div class="form-group" >
                                    <label>Trạng thái</label>
                                    <select required name="status" class="form-control" col="7">

                                        <option value="0">
                                            Đang xác nhận
                                        </option>
                                        <option value="1">
                                            Đang Giao hàng
                                        </option>
                                        <option value="2">
                                            Đã giao hàng
                                        </option>
                                        <option value="3">
                                            Đã hủy
                                        </option>

                                    </select>
                                </div>
                                    </td>
                                    <td>
                                         <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                                    </td>
                                </tr>
                            </form>
                            @endif
                        </div>
                        </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div><!--/.row-->
</div>	<!--/.main-->
@endsection
