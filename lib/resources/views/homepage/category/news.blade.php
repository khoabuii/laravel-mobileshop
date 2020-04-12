@extends('homepage.layouts.new-master')
@section('content')
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <h3 class="panel-title">
      <span class="glyphicon glyphicon-home"><a href="#" title=""> Home</a></span>
      <span class="glyphicon glyphicon-chevron-right" style="font-size: 11px;"></span><a href="#" title=""> Tin Tức </a>
    </h3>
    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 no-padding">

      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="panel panel-success">
            <div class="panel-body">
              <div class="row">
                @foreach($new as $new)
                  <div class="col-lg-12 no-padding">
                    <hr>
                    <div class="col-lg-3">
                      <a href="{!!url('/blog/'.$new->blog_id.'-'.$new->blog_slug)!!}" title="{!!$new->blog_title!!}"><img src="{!!url('/lib/storage/app/blog/'.$new->blog_img)!!}" alt="" width="90%" height="99%"> </a>
                    </div>
                    <div class="col-lg-9">
                      <h4><a href="{!!url('/blog/'.$new->blog_id.'-'.$new->blog_slug)!!}" title="">{!!$new->blog_title!!}</a></h4>
                      <p><strong>View :</strong> {!!$new->blog_view!!}  </p>
                      <p>
                        {!!$new->blog_summary!!}
                      </p>
                      <p><strong>Lúc :</strong> {!!$new->created_at!!}  </p>
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
