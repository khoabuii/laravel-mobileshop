@extends('homepage.layouts.new-master')
@section('content')
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <h3 class="panel-title">
      <span class="glyphicon glyphicon-home"><a href="{!!url('/')!!}" title=""> Home</a></span>
      <span class="glyphicon glyphicon-chevron-right" style="font-size: 11px;"></span><a href="{!!url('/mobile')!!}" title=""> Điện thoại</a>
      <span class="glyphicon glyphicon-chevron-right" style="font-size: 11px;"></span> <a href="#" title="">{{$product->prod_slug}}</a>
    </h3>
    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 no-padding">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
          <div class="panel panel-success">
            <div class="panel-body">
              <div class="row">
              <!-- hot new content -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-padding">
                  <h3 class="pro-detail-title"><a href="{!!url('/product/'.$product->prod_id.'-'.$product->prod_slug)!!}" title="">{!!$product->prod_name!!}</a></h3>
                  <hr>
                  <div class="row">
                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                      <div class="img-box">
                        <img class="img-responsive img-mobile" src="{!!url('lib/storage/app/avatar/'.$product->prod_img)!!}" alt="img responsive">
                      </div>
                      <div class="img-slide">
                        <div class="panel panel-default text-center">
                            <!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->

                          </div>
                        </div>
                    @if($product->prod_promotion_price==null)
                      <label class="btn btn-large btn-block btn-warning">{!!number_format($product->prod_price)!!} vnd</label>
                    @else
                      <strike><label class="btn btn-large btn-block btn-warning">{!!number_format($product->prod_price)!!} vnd</label></strike>
                      <br>

                      <label class="btn btn-large btn-block btn-warning">{!!number_format($product->prod_promotion_price)!!} vnd</label>
                    @endif
                    </div>
                    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                      <div class="panel panel-info" style="margin: 0;">
                        <div class="panel-heading" style="padding:5px;">
                          <h3 class="panel-title">Khuyễn mãi - Chính sách</h3>
                        </div>
                        <div class="panel-body">
                          <div class="khuyenmai">

                              <li><span class="glyphicon glyphicon-ok-sign"></span>{{$product->prod_promotion}}</li>
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-info">
                        <div class="panel-body">
                         <div class="chinhsach">
                            <li><span class="glyphicon glyphicon-hand-right"></span> Phụ kiện: {!!$product->prod_accessories!!} </li>
                            <li><span class="glyphicon glyphicon-hand-right"></span> Bảo hành: {{$product->prod_warranty}}</li>
                            <li><span class="glyphicon glyphicon-hand-right"></span> Tình trạng: {{$product->prod_condition}}</li>
                            <li><span class="glyphicon glyphicon-hand-right"></span> 1 đổi 1 trong 1 tháng với sản phẩm lỗi</li>
                         </div>
                        </div>
                      </div>
                      @if($product->prod_status ==1)
                        <a href="{!!url('gio-hang/addcart/')!!}" title="" class="btn btn-large btn-block btn-primary" style="font-size: 20px;">Đặt hàng ngay</a>
                      @else
                        <a href="" title="" class="btn btn-large btn-block btn-primary disabled" style="font-size: 20px;">Tạm hết hàng</a>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              <hr>

              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                  <h2> <small> Đánh giá chi tiết sản phẩm</small></h2>
                  <div class="accordion-group">
                    <div class="accordion-heading">
                      <p class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                        {!!$product->prod_description!!}
                      </p>
                    </div>
                    <div id="collapseTwo" class="accordion-body collapse">
                      <div class="accordion-inner">
                          <!--  -->
                      </div>
                    </div>
                    <button class="SeeMore btn-primary" data-toggle="collapse" href="#collapseTwo"><b class="caret"></b> Xem chi tiết</button>
                  </div>
                </div>
              </div>
              <div class="row">
                <hr>
                <h2 style="padding-left: 20px;"><small>Tin tức mới</small></h2>
                <hr>
                @include('homepage.modules.tin-tuc')
              </div><!-- /row -->

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
                      <strike>{!!number_format($llq->prod_price)!!} VND</strike>
                    </label>
                        <p></p>
                      <span class="btn label-warning">{!!number_format($lq->prod_promotion_price)!!} VND</span>
                    @endif
                 </div>
                <div class="intro pull-right">
                  <h1><small class="title-mobile">{!!$lq->prod_name!!}</small></h1>
                  @if($lq->prod_status==1)
                  <li>Còn hàng</li>
                  @else
                  <li>Hết hàng</li>
                  @endif
                  <span class="label label-info">Khuyễn mãi</span>
                    <li><span class="glyphicon glyphicon-ok-sign"></span>{!!$lq->prod_promotion!!}</li>

                </div><!-- /div introl -->



                <a href="" class="btn btn-success pull-right ">Thêm vào giỏ </a>
            </div> <!-- / div thumbnail -->
          </div>  <!-- /div col-4 -->
        @endforeach

        </div>
      </div> <!-- /panel info 2  quản cáo 1          -->

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
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Thống kê</h3>
      </div>
      <div class="panel-body">
        <p>Số bài viết: </p>
        <p>Số Thành Viên : </p>
        <p>Số Thành Viên Online: </p>
        <p>Số Người Đang Xem : </p>
      </div>
    </div>
     <!-- /panel info 2  quản cáo 1          -->
     <!-- fan pages myweb -->
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Fans Pages</h3>
      </div>
      <div class="panel-body">
        Hãy <a href="#" title="">Like</a> facebook của MyWeb để cập nhật tin mới nhất
      </div>
    </div> <!-- /fan pages myweb -->
  </div>
</div>
<!-- ===================================================================================/news ============================== -->
@endsection
