@extends('homepage.layouts.master')
@section('content')
@if(session('script'))
<script>
alert('Cảm ơn bạn đã góp ý')
</script>
@endif

@if(session('order'))
<script>
alert('Bạn đã đặt hàng thành công- Đơn hàng của bạn sẽ sớm được giao')
</script>
@endif
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<h2 class="title-moble">Sản phẩm nổi bật</h2>
        <!-- danh muc dien thoai -->
        @foreach($featured as $fe)
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 no-padding">

            <div class="thumbnail mobile">
              <div class="btm">
                <div class="image-m pull-left">
                  <img class="img-responsive" src="{!!url('lib/storage/app/avatar/'.$fe->prod_img)!!}" alt="img responsive">
                  @if($fe->prod_promotion_price==null)
                      <span class="btn label-warning">{!!number_format($fe->prod_price)!!} VND</span>
                    @else
                      <label class="btn label-warning">
                      <strike>{!!number_format($fe->prod_price)!!} VND</strike>
                    </label>
                        <p></p>
                      <span class="btn label-warning">{!!number_format($fe->prod_promotion_price)!!} VND</span>
                    @endif
                </div>
                <div class="intro pull-right">
                 <a href="{{url('/product/'.$fe->prod_id.'-'.$fe->prod_slug)}}"><h1><small class="title-mobile">{!!$fe->prod_name!!}</small></h1>  </a>
                  <li>
                      @if($fe->prod_status==1)
                      Còn hàng
                      @else
                      Hết hàng
                      @endif
                  </li>
                  <span class="label label-info">Khuyễn mãi</span>
                  <li><span class="glyphicon glyphicon-hand-right"></span> {!!$fe->prod_promotion!!}</li>

                  <span class=" label-info">Tình trạng: <strong>{!!$fe->prod_condition!!}</strong></span>

                </div><!-- /div introl -->
              </div> <!-- /div bt -->

                <a href="{!!url('cart/add/'.$fe->prod_id)!!}" class="btn btn-success pull-right ">Thêm vào giỏ </a>
            </div> <!-- / div thumbnail -->
          </div>  <!-- /div col-4 -->
          @endforeach
          </div> <!-- /col 12 -->
<a href="product_feature">Xem thêm</a>
<br>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

          <!-- Moi 100/ hang chinh hang -->
          <h2 class="title-moble">Hàng mới/Chính hảng</h2>
        <!-- danh muc dien thoai -->
        @foreach($new as $new)
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 no-padding">

            <div class="thumbnail mobile">
              <div class="btm">
                <div class="image-m pull-left">
                  <img class="img-responsive" src="{!!url('lib/storage/app/avatar/'.$new->prod_img)!!}" alt="img responsive">
                  @if($new->prod_promotion_price==null)
                      <span class="btn label-warning">{!!number_format($new->prod_price)!!} VND</span>
                    @else
                      <label class="btn label-warning">
                      <strike>{!!number_format($new->prod_price)!!} VND</strike>
                    </label>
                        <p></p>
                      <span class="btn label-warning">{!!number_format($new->prod_promotion_price)!!} VND</span>
                    @endif
                </div>
                <div class="intro pull-right">
                 <a href="{{url('/product/'.$new->prod_id.'-'.$new->prod_slug)}}"><h1><small class="title-mobile">{!!$new->prod_name!!}</small></h1>  </a>
                  <li>
                      @if($new->prod_status==1)
                      Còn hàng
                      @else
                      Hết hàng
                      @endif
                  </li>
                  <span class="label label-info">Khuyễn mãi</span>
                  <li><span class="glyphicon glyphicon-hand-right"></span> {!!$new->prod_promotion!!}</li>

                  <span class=" label-info">Tình trạng: <strong>{!!$new->prod_condition!!}</strong></span>
                </div><!-- /div introl -->
              </div> <!-- /div bt -->
                <a href="{!!url('cart/add/'.$new->prod_id)!!}"  class="btn btn-success pull-right ">Thêm vào giỏ </a>
            </div> <!-- / div thumbnail -->
          </div>  <!-- /div col-4 -->
          @endforeach
          <!-- danh muc dien thoai -->

          <div class="clearfix">
          </div>
<a href="product_new">Xem thêm</a>
        <!--========================== phan danh muc laptop   =========================================  -->
</div> <!-- /col 12 -->
@endsection

