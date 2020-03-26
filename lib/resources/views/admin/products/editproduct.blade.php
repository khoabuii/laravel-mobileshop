@extends('admin.layout.main')
@section('content')

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{$product->prod_name}}</h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="panel panel-primary">
                <div class="panel-heading">Sửa sản phẩm</div>
                <div class="panel-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="row" style="margin-bottom:40px">
                            <div class="col-xs-8">
                                <div class="form-group" >
                                    <label>Tên sản phẩm</label>
                                    <input required type="text" value="{{$product->prod_name}}" name="name" class="form-control">
                                </div>
                                <div class="form-group" >
                                    <label>Giá sản phẩm</label>
                                    <input required type="number" value="{{$product->prod_price}}" name="price" class="form-control">
                                </div>
                                <div class="form-group" >
                                    <label>Giá khuyến mãi</label>
                                    <input type="number" value="{{$product->prod_promotion_price}}" name="promotion_price" class="form-control">
                                </div>
                                <div class="form-group" >
                                    <label>Ảnh sản phẩm</label>
                                    <input id="img" type="file" name="img" class="form-control hidden" onchange="changeImg(this)">
                                    <img id="avatar" class="thumbnail" width="300px" src="{{asset('lib/storage/app/avatar')}}/{{$product->prod_img}}">
                                </div>
                                <div class="form-group" >
                                    <label>Phụ kiện</label>
                                    <input required type="text" value="{{$product->prod_accessories}}" name="accessories" class="form-control">
                                </div>
                                <div class="form-group" >
                                    <label>Bảo hành</label>
                                    <input required type="text" value="{{$product->prod_warranty}}" name="warranty" class="form-control">
                                </div>
                                <div class="form-group" >
                                    <label>Khuyến mãi</label>
                                    <input required type="text" value="{{$product->prod_promotion}}" name="promotion" class="form-control">
                                </div>
                                <div class="form-group" >
                                    <label>Tình trạng</label>
                                    <input required type="text" value="{{$product->prod_condition}}" name="condition" class="form-control">
                                </div>
                                <div class="form-group" >
                                    <label>Trạng thái</label>
                                    <select required name="status" class="form-control">

                                        <option @if($product->prod_status==1) selected
                                            @endif
                                             value="1">Còn hàng

                                            </option>
                                        <option
                                        @if($product->prod_status==0) selected @endif
                                        value="0">Hết hàng</option>

                                    </select>
                                </div>
                                <div class="form-group" >
                                    <label>Miêu tả</label>
                                    <textarea required class="ckeditor" name="description">{{$product->prod_description}}</textarea>
                                </div>
                                <script type="text/javascript">
                                    var editor = CKEDITOR.replace('content',{
                                        language:'vi',
                                        filebrowserImageBrowseUrl: '../../ckfinder/ckfinder.html?Type=Images',
                                        filebrowserFlashBrowseUrl: '../../ckfinder/ckfinder.html?Type=Flash',
                                        filebrowserImageUploadUrl: '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                        filebrowserFlashUploadUrl: '../../public/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                                    });
                                </script>

                                <div class="form-group" >
                                    <label>Danh mục</label>
                                    <select required name="cate" class="form-control">
                                        @foreach($category as $cate)
                                        <option
                                        @if($product->prod_cate) selected @endif
                                         value="{{$cate->cate_id}}">{{$cate->cate_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" >
                                    <label>Sản phẩm nổi bật</label><br>
                                    Có: <input type="radio"
                                    @if($product->prod_featured==1) checked @endif
                                    name="featured" value="1">
                                    Không: <input type="radio"
                                    @if($product->prod_featured==0) checked @endif
                                     name="featured" value="0">
                                </div>
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
