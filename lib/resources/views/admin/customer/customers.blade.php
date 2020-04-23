@extends('admin.layout.main')
@section('title','Khách hàng')
		@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Khách hàng</h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="panel panel-primary">
                <div class="panel-heading">Danh sách Khách hàng</div>
                @include('noti.success')
                <div class="panel-body">
                    <div class="bootstrap-table">
                        <div class="table-responsive">
                            <table class="table table-striped" style="margin-top:20px;">
                                <thead>
                                    <tr id="tbl-first-row" class="bg-primary">
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Avatar</th>
                                        <th>google_id</th>
                                        <th>Email</th>
                                        <th>Địa chỉ</th>
                                        <th>SDT</th>
                                        <th>Tùy chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customers as $cus)
                                    <tr>
                                        <td>{{$cus->id}}</td>
                                        <td>{{$cus->name}}

                                        </td>
                                        <td>
                                <img width="150px" src="{{$cus->avatar}}" class="thumbnail" class="thumbnail">
                                        </td>

                                        <td>
                                            {{$cus->google_id}}
                                        </td>
                                        <td>
                                            {{$cus->email}}
                                        </td>
                                        <td>
                                            {{$cus->address}}
                                        </td>
                                        <td>
                                            {{$cus->numberPhone}}
                                        </td>
                                        <td>

                                            <a href="{{asset('admin/customers/delete')}}/{{$cus->id}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
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
