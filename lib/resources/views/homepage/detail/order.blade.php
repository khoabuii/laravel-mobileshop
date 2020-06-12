@extends('homepage.layouts.new-master')
@section('content')
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <h3 class="panel-title">
      <span class="glyphicon glyphicon-home"><a href="#" title=""> Home</a></span>
      <span class="glyphicon glyphicon-chevron-right" style="font-size: 11px;"></span><a href="#" title=""> Đặt hàng</a>
      <span class="glyphicon glyphicon-chevron-right" style="font-size: 11px;"></span> <a href="#" title=""></a>
    </h3>
    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 no-padding">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
          <div class="panel panel-success">
            <div class="panel-body">
            <legend class="text-left">Xác nhận thông tin đơn hàng</legend>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Hình ảnh</th>
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
                      <td><img src="{!!url('lib/storage/app/avatar/'.$prod->prod_img)!!}" alt="dell" width="80" height="50"></td>
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
              {{-- form thong tin khach hang dat hang           --}}

              <form action="" method="POST" role="form">
                <legend class="text-left">Xác nhận thông tin khách hàng</legend>
                {{ csrf_field() }}
                <div class="form-group">
                      <label for="">Tên khách hàng: </label>
                      <input class="form-control" required type="text" name="name" value="{{Auth::user()->name}}">
                </div>
                <div class="form-group">
                      <label for="">Địa chỉ nhận hàng: </label>
                      <input class="form-control" required name="address" type="text" value="{{Auth::user()->address}}">
                </div>
                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                      <label for="">Phone: </label>
                      <input class="form-control" required name="phone" type="number" value="0{{Auth::user()->numberPhone}}">
                      @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong style="color:red">{{ $errors->first('phone') }}</strong>
                            </span>
                      @endif
                </div>
                <div class="form-group">
                  <label for="">Ghi chú: </label>
                  <textarea name="note" id="inputtxtNote" class="form-control" rows="4">
                  </textarea>
                </div>
                <button type="submit" class="btn btn-primary pull-right"> Đặt hàng (COD)</button>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
     <!-- fan pages myweb -->
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Fans Pages</h3>
      </div>
      <div class="panel-body">
        Hãy <a href="#" title="">Like</a> facebook của chung tôi để cập nhật tin mới nhất
        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fttth.khoabui%2F&tabs=272&width=340&height=180&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=235680100923976" width="340" height="180" style="border:none;overflow:hidden"
        scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
      </div>

    </div> <!-- /fan pages myweb -->
  </div>
</div>
<!-- ===================================================================================/news ============================== -->
@endsection
