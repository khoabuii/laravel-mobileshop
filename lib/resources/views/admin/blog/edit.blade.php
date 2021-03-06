@extends('admin.layout.main')
@section('content')

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{$blogs->blog_title}}</h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="panel panel-primary">
                <div class="panel-heading">Sửa Bài viết</div>
                @include('noti.errors')
                <div class="panel-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="row" style="margin-bottom:40px">
                            <div class="col-xs-8">
                                <div class="form-group" >
                                    <label>Tiêu đề</label>
                                    <input required value="{{$blogs->blog_title}}" type="text" name="name" class="form-control">
                                </div>

                                <div class="form-group" >
                                    <label>Ảnh bài viết</label>
                                    <input id="img" type="file" name="img" class="form-control hidden" onchange="changeImg(this)">
                                    <img id="avatar" class="thumbnail" width="300px" src="{{asset('lib/storage/app/blog')}}/{{$blogs->blog_img}}">
                                </div>

                                <div class="form-group" >
                                    <label>Tóm tắt</label>
                                    <textarea class="form-control"  required name="summary">{{$blogs->blog_summary}}</textarea>
                                </div>

                                <div class="form-group" >
                                    <label>Nội dung bài viết</label>
                                    <textarea required class="ckeditor" name="description">{{$blogs->blog_content}}</textarea>
                                </div>
                                <script type="text/javascript">
                                    var editor = CKEDITOR.replace('description',{
                                        language:'vi',
                                        filebrowserImageBrowseUrl: '../../public/admin/ckfinder/ckfinder.html?Type=Images',
                                        filebrowserFlashBrowseUrl: '../../public/admin/ckfinder/ckfinder.html?Type=Flash',
                                        filebrowserImageUploadUrl: '../../public/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                        filebrowserFlashUploadUrl: '../../public/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                                    });
                                </script>
                                <input type="submit" name="submit" value="Thêm" class="btn btn-primary">
                                <a href="{{asset('admin/product')}}" class="btn btn-danger">Hủy bỏ</a>
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
