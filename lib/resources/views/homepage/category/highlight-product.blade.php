@extends('homepage.layouts.new-master')
@section('content')
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<h1 class="title-moble">Sản phẩm nổi bật</h1>
        <!-- danh muc dien thoai -->
        @foreach($highlight_product as $prod)
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 no-padding">

            <div class="thumbnail mobile">
              <div class="btm">
                <div class="image-m pull-left">
                  <img class="img-responsive" src="{!!url('lib/storage/app/avatar/'.$prod->prod_img)!!}" alt="img responsive">
                  @if($prod->prod_promotion_price==null)
                      <span class="btn label-warning">{!!number_format($prod->prod_price)!!} VND</span>
                    @else
                      <label class="btn label-warning">
                      <strike>{!!number_format($prod->prod_price)!!} VND</strike>
                    </label>
                        <p></p>
                      <span class="btn label-warning">{!!number_format($prod->prod_promotion_price)!!} VND</span>
                    @endif
                </div>
                <div class="intro pull-right">
                 <a href="{!!url('product/'.$prod->prod_id.'-'.$prod->prod_slug)!!}"><h1><small class="title-mobile">{!!$prod->prod_name!!}</small></h1>  </a>
                  <li>
                      @if($prod->prod_status==1)
                      <p style="color:seagreen">CÒN HÀNG</p>
                      @else
                      <p style="color:red">HẾT HÀNG</p>
                      @endif
                  </li>
                  <span class="label label-info">Khuyễn mãi</span>
                  <li><span class="glyphicon glyphicon-hand-right"></span> {!!$prod->prod_promotion!!}</li>

                  <span class=" label-info">Tình trạng: <strong>{!!$prod->prod_condition!!}</strong></span>

                </div><!-- /div introl -->
              </div> <!-- /div bt -->



                <a href="{!!url('cart/add/'.$prod->prod_id)!!}" class="btn btn-success pull-right ">Thêm vào giỏ </a>
            </div> <!-- / div thumbnail -->
          </div>  <!-- /div col-4 -->
          @endforeach
          </div> <!-- /col 12 -->
      <div class="clearfix">

      </div>
      <!-- ===================================================================================/products ============================== -->
      {!!$highlight_product->render();!!}
@endsection
