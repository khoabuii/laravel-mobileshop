@extends('homepage.layouts.master')

@section('content')
<div class="container">
<div class="row">
    <h2 class="title-moble"> Thông tin khách hàng : <strong>{!!Auth::user()->name !!}</strong></h2>
<form class="form-horizontal" role="form" method="POST" action="">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Tên</label>

                    <div class="col-md-6">
                        <input id="name" type="text" required class="form-control" name="name"  value="{{ Auth::user()->name }}">

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">Địa chỉ E-Mail</label>

                    <div class="col-md-6">
                        <input id="email" disabled type="email"  class="form-control" name="email" value="{{ Auth::user()->email }}">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                    <label for="avatar" class="col-md-4 control-label">Ảnh đại diện</label>

                    <div class="col-md-6">
                        <input id="avatar" onchange="changeImg(this)" type="file" class="form-control" name="avatar" value="">
                        @if ($errors->has('avatar'))
                            <span class="help-block">
                                <strong>{{ $errors->first('avatar') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                <input type="checkbox" name='changePassword' id='changePassword'>
                </div>


                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Mật khẩu</label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control password"  name="password">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm" class="col-md-4 control-label">Xác nhận mật khẩu</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control password" name="password_confirmation" >
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <label for="phone" class="col-md-4 control-label">Số điện thoại</label>

                    <div class="col-md-6">
                        <input id="phone" type="number" class="form-control" name="phone"  value="{{ Auth::user()->numberPhone }}">

                        @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                    <label for="address" class="col-md-4 control-label">Địa chỉ</label>

                    <div class="col-md-6">
                        <input id="address" type="text" class="form-control" name="address"  value="{{ Auth::user()->address }}">

                        @if ($errors->has('address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-user"></i> Sửa
                        </button>
                    </div>
                </div>
        </form>
</div>
</div>
@endsection
@section('script')
        <script>
            $(document).ready(function(){
                $("#changePassword").change(function(){
                    if($(this).is(":checked")){
                        $(".password").removeAttr('disabled');
                    }else{
                        $(".password").attr('disabled','');
                    }
                });
            });
        </script>
@endsection
