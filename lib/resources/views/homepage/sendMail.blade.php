<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

    <legend class="text-left">Xác nhận thông tin khách hàng</legend>

        <div class="form-group">
                <label for="">Tên khách hàng: </label>{{Auth::user()->name}}
        </div>
        <br>
        <div class="form-group">
                <label for="">Địa chỉ nhận hàng: </label>{{Auth::user()->address}}

        </div>
        <br>
        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="">Phone: </label>{{Auth::user()->numberPhone}}

        </div>
       <br>
    <legend class="text-left">Xác nhận thông tin đơn hàng</legend>
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
        @foreach($prod as $prod)
        <tr>
            <td>{{$prod->prod_id}}</td>

            <td>{{$prod->prod_name}}</td>
            <td class="text-center">

                @if (($prod->cart_quantity) >1)
                <!-- <a href="{!!url('gio-hang/update/')!!}"><span class="glyphicon glyphicon-minus"></span></a> -->
                @else
                <!-- <a href="#"><span class="glyphicon glyphicon-minus"></span></a> -->
            @endif
                <input type="text" class="qty text-center" value=" {{$prod->cart_quantity}}" style="width:30px; font-weight:bold; font-size:15px; color:blue;" readonly="readonly">
            <!-- <a href="{!!url('cart/update/')!!}"><span class="glyphicon glyphicon-plus-sign"></span></a> -->
            </td>
            <!-- <td><a href="{!!url('cart/delete/')!!}" onclick="return xacnhan('Xóa sản phẩm này ?')" ><span class="glyphicon glyphicon-remove" style="padding:5px; font-size:18px; color:red;"></span></a></td> -->
            <td>
            @if($prod->prod_promotion_price){
                {{number_format($prod->prod_promotion_price)}}
            }
            @else
            {{number_format($prod->prod_price)}}
            @endif
            Vnd</td>
            <td>
            @if($prod->prod_promotion_price)
            {{number_format($prod->prod_promotion_price * $prod->cart_quantity)}}
            @else
            {{number_format($prod->prod_price * $prod->cart_quantity)}}
            @endif
            Vnd</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="3"><strong>Tổng cộng :</strong> </td>
            <td>{!!$count!!}</td>
            <td colspan="2" style="color:red;">{{number_format($sum)}}Vnd</td>
        </tr>
        </tbody>
    </table>
    </div>
</body>
</html>
