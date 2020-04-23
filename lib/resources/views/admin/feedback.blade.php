@extends('admin.layout.main')
@section('title','Phản hồi')
		@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Feedback</h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="panel panel-primary">
                <div class="panel-heading">Danh sách các phản hồi</div>
                @include('noti.success')
                <div class="panel-body">
                    <div class="bootstrap-table">
                        <div class="table-responsive">
                            <table class="table table-striped" style="margin-top:20px;">
                                <thead>
                                    <tr id="tbl-first-row" class="bg-primary">
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Tiêu đề</th>
                                        <th>Nội dung</th>
                                        <th>Tùy chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($feed as $feed)
                                    <tr>
                                        <td>{{$feed->feed_id}}</td>
                                        <td>{{$feed->feed_name}}

                                        </td>
                                        <td>
                                            {{$feed->feed_email}}
                                        </td>

                                        <td>
                                            {{$feed->feed_title}}
                                        </td>
                                        <td>
                                            {{$feed->feed_content}}
                                        </td>

                                        <td>

                                            <a href="{{asset('admin/feedback/delete')}}/{{$feed->feed_id}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
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
