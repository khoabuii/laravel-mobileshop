@extends('homepage.layouts.new-master')
@section('content')
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <h3 class="panel-title">
      <span class="glyphicon glyphicon-home"><a href="#" title=""> Home</a></span>
      <span class="glyphicon glyphicon-chevron-right" style="font-size: 11px;"></span><a href="#" title=""> Post</a>
      <span class="glyphicon glyphicon-chevron-right" style="font-size: 11px;"></span> <a href="#" title="">{!!$blog->blog_slug!!}</a>
    </h3>
    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 no-padding">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="panel panel-success">
            <div class="panel-body">
              <div class="row">
              <!-- hot new content -->
                <div class="col-lg-12">
                  <h3 class="title-h3"><a href="#" title="{!!$blog->blog_title!!}">{!!$blog->blog_title!!}</a></h3>
                   <p class="time-views"> <span>View: </span><strong>{{$blog->blog_view}}</strong></p>
                   <span style="font-size:10px;color:#bdc3c7;">Đăng vào: {!!$blog->created_at!!} </span>
                  <img class="img-new" src="{!!url('lib/storage/app/blog/'.$blog->blog_img)!!}" alt="" >
                  <p class="summary-content">
                  <div class="panel-body">

                      <div class="accordion-inner">
                        {!!$blog->blog_content!!}
                      </div>

                      <span style="font-size:10px;color:#bdc3c7;">Sử lần cuối: {!!$blog->updated_at!!} </span></p>

                  </div>
                  </p>
                </div>
              </div>
              <div class="row">
                <?php
                    $data = DB::table('blogs')
                    ->orderBy('created_at', 'desc')
                    ->paginate(5);
                  ?>
                <h1 style="padding-left: 20px;"> Tin khác</h1>
                <hr>
                @foreach($data as $row)
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                      <a href="{!!url('/blog/'.$row->blog_id.'-'.$row->blog_slug)!!}" title="{!!$row->blog_title!!}"><img src="{!!url('lib/storage/app/blog/'.$row->blog_img)!!}" alt="" width="90%" height="99%"> </a>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                      <h4><a href="{!!url('/blog/'.$row->blog_id.'-'.$row->blog_slug)!!}"" title="{!!$row->blog_title!!}">{!!$row->blog_title!!}</a></h4>
                      <p>
                        {!!$row->blog_summary!!}
                      </p>
                      <p><strong>Lúc :</strong> {!!$row->created_at!!}</p>
                    </div>
                  </div>
                @endforeach
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
          <h3 class="panel-title text-center">Sản phẩm mới</h3>
        </div>
        <div class="panel-body no-padding">

        @foreach($product_new as $lq)
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-padding">
            <div class="thumbnail mobile">

                <div class="image-m pull-left">
                  <img class="img-responsive" src="{!!url('lib/storage/app/avatar/'.$lq->prod_img)!!}" alt="">
                </div>
                <div class="intro pull-right">
                 <a href="{!!url('/product/'.$lq->prod_id.'-'.$lq->prod_slug)!!}"> <h1><small class="title-mobile">{!!$lq->prod_name!!}</small></h1></a>
                  @if($lq->prod_status==1)
                  <li>Còn hàng</li>
                  @else
                  <li>Hết hàng</li>
                  @endif
                  <span class="label label-info">Khuyễn mãi</span>
                    <li><span class="glyphicon glyphicon-ok-sign"></span>{!!$lq->prod_promotion!!}</li>

                </div><!-- /div introl -->


                <span class="btn label-warning"><strong>{!!number_format($lq->prod_price)!!}</strong>Vnd </span>
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
     <!-- /panel info 2  quản cáo 1          -->
     <!-- fan pages myweb -->
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Fans Pages</h3>
      </div>
      <div class="panel-body">
        Hãy <a href="#" title="">Like</a> facebook của Fshop để cập nhật tin mới nhất
      </div>
    </div> <!-- /fan pages myweb -->
  </div>
</div>
<!-- ===================================================================================/news ============================== -->
@endsection
