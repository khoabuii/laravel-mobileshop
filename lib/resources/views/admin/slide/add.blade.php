@extends('admin.layout.main')
@section('content')

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Slide</h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="panel panel-primary">
                <div class="panel-heading">Thêm Slide</div>
                <div class="panel-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="row" style="margin-bottom:40px">
                            <div class="col-xs-8">
                                <div class="form-group" >
                                    <label>Tên Slide</label>
                                    <input required type="text" name="name" class="form-control">
                                </div>

                                <div class="form-group" >
                                    <label>Ảnh</label>
                                    <input required id="img" type="file" name="img" class="form-control hidden" onchange="changeImg(this)">
                                    <img id="avatar" class="thumbnail" width="300px" src="img/new_seo-10-512.png">
                                </div>

                                <div class="form-group" >
                                    <label>Link</label>
                                    <input required type="text" name="link" class="form-control">
                                </div>

                                <div class="form-group" >
                                    <label>Trạng thái</label>
                                    <select required name="status" class="form-control">
                                        <option value="1">Hiện</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>

                                <input type="submit" name="submit" value="Thêm" class="btn btn-primary">
                                <a href="{{asset('admin/slide')}}" class="btn btn-danger">Hủy bỏ</a>
                            </div>
                        </div>
                        {{csrf_field()}}
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div><!--/.row-->
</div>	<!--/.main-->
	@endsection
