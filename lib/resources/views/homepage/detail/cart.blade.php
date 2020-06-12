@extends('homepage.layouts.new-master')
@section('title','Giỏ hàng')
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
          <div class="panel panel-success" style="min-height: 1760px;">
        @if (count($errors) > 0)
              <div class="alert alert-danger">
                  <ul>
                      {{-- @foreach ($errors->all() as $error)--}}
                          <li>{{-- $error --}}</li>
                      {{--@endforeach--}}
                  </ul>
            </div>
            {{-- @elseif (Session()->has('flash_level')) --}}
              <div class="alert alert-success">
                  <ul>
                      {{--Session::get('flash_massage') --}}
                  </ul>
              </div>
          @endif
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Hình ảnh</th>
                      <th>Tên sản phẩm</th>
                      <th>SL</th>
                      <th>Action</th>
                      <th>Đơn Giá</th>
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
                          <a href="{!!url('cart/updateReduct/'.$prod->cart_id)!!}"><span class="glyphicon glyphicon-minus"></span></a>
                         @else
                            <a href="{!!url('cart/updateReduct/'.$prod->cart_id)!!}"><span class="glyphicon glyphicon-minus"></span></a>
                        @endif
                          <input type="text" class="qty text-center" value=" {{$prod->cart_quantity}}" style="width:30px; font-weight:bold; font-size:15px; color:blue;" readonly="readonly">
                        <a href="{!!url('cart/updatePlus/'.$prod->cart_id)!!}"><span class="glyphicon glyphicon-plus-sign"></span></a>
                      </td>
                      <td><a href="{!!url('cart/delete/'.$prod->cart_id)!!}" onclick="return xacnhan('Xóa sản phẩm này ?')" ><span class="glyphicon glyphicon-remove" style="padding:5px; font-size:18px; color:red;"></span></a></td>
                      <td>
                      @if($prod->prod_promotion_price)
                          {{number_format($prod->prod_promotion_price)}}

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
                      <td>{{$count}}</td>
                      <td colspan="2" style="color:red;">{{number_format($sum)}} Vnd</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col-xs-12 col-sm-12 col-md-12 no-paddng">

                  <!-- <div class="input-group">
                      <select name="paymethod" id="inputPaymethod" class="form-control" required="required">
                        <option value="cod">COD (thanh toán khi nhận hàng)</option>
                        <option value="paypal">Paypal (Thanh toán qua Paypal)</option>
                      </select>
                    </div> -->
                  <!-- <a class="btn btn-large btn-warning pull-right" href="{!!url('/login')!!}" >Tiến hàng thanh toán</a> -->

                  <!-- <form action="{!!url('/dat-hang')!!}" method="get" accept-charset="utf-8">
                    <div class="input-group"> -->
                    <!-- <label for="paymethod">Chọn phương thức thanh toán</label>
                      <select name="paymethod" id="inputPaymethod" class="form-control" required="required">
                        <option value="">Hãy chọn phương thức thanh toán</option>
                        <option value="paypal">Thanh toán trực tuyến ( Paypal )</option>
                        <option value="cod"> Thanh toán khi nhận hàng ( COD )</option>
                      </select> -->
                    <!-- </div>
                    <hr> -->
                      <a href="{!!url('checkout')!!}" class="btn btn-danger pull-right">Tiến hành đặt hàng</button>
                      <a href="{!!url('/')!!}" type="button" class="btn btn-large btn-primary pull-left">Tiếp tục mua hàng</a>
                  <!-- </form> -->


              </div>
              <hr>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 no-padding">
       <!-- panel inffo 1 -->
       <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title text-center">Sản phẩm tương tự</h3>
        </div>
        <div class="panel-body no-padding">

        @foreach($product_lq as $lq)
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-padding">
            <div class="thumbnail mobile">

                <div class="image-m pull-left">
                  <img class="img-responsive" src="{!!url('lib/storage/app/avatar/'.$lq->prod_img)!!}" alt="">

                  @if($lq->prod_promotion_price==null)
                      <span class="btn label-warning">{!!number_format($lq->prod_price)!!} VND</span>
                    @else
                      <label class="btn label-warning">
                      <strike>{!!number_format($lq->prod_price)!!} VND</strike>
                    </label>
                        <p></p>
                      <span class="btn label-warning">{!!number_format($lq->prod_promotion_price)!!} VND</span>
                    @endif
                 </div>
                <div class="intro pull-right">
                  <h1><a href="{!!url('/product/'.$lq->prod_id.'-'.$lq->prod_slug)!!}"><small class="title-mobile">{!!$lq->prod_name!!}</small></a></h1>
                  @if($lq->prod_status==1)
                  <li>Còn hàng</li>
                  @else
                  <li>Hết hàng</li>
                  @endif
                  <span class="label label-info">Khuyễn mãi</span>
                    <li><span class="glyphicon glyphicon-ok-sign"></span>{!!$lq->prod_promotion!!}</li>
                </div><!-- /div introl -->
                <a href="{{url('cart/add/'.$lq->prod_id)}}" class="btn btn-success pull-right ">Thêm vào giỏ </a>
            </div> <!-- / div thumbnail -->
          </div>  <!-- /div col-4 -->
        @endforeach

    <!-- panel info 2  quản cáo 1          -->
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title text-center">Sự kiện HOT</h3>
      </div>
      <div class="panel-body no-padding">
          @foreach($slide as $slide)
          @if($slide->status==1)
        <a href="{{$slide->slide_link}}" title=""><img src="{!!url('lib/storage/app/slide/'.$slide->slide_img)!!}" alt="" width="100%" height="100%"> </a> <br>
       @endif
        @endforeach
      </div>
    </div> <!-- /panel info 2  quản cáo 1          -->

     <!-- fan pages myweb -->
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Fans Pages</h3>
      </div>
      <div class="panel-body">
        Hãy <a href="#" title="">Like</a> facebook của MyWeb để cập nhật tin mới nhất
      </div>
      <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fttth.khoabui%2F&tabs=272&width=340&height=180&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=235680100923976" width="340" height="180" style="border:none;overflow:hidden"
        scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
    </div> <!-- /fan pages myweb -->
  </div>
</div>
<!-- ===================================================================================/news ============================== -->
@endsection
