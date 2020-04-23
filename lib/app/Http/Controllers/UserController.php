<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Slide;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $construct['cate']=Category::all();
        $construct['cate1']=Category::all();
        $construct['slide']=Slide::all();
        view()->share($construct);
    }
    public function getUser(){
        if(Auth::user())
        return view('homepage.member.user');
        else
        return redirect('/');
    }
    public function getUserEdit(){
        return view('homepage.member.edit');
    }

    public function postUserEdit(Request $request){
        if(empty(Auth::user())){
            return false;
        }
        $this->validate($request,
        [
            'name'=>'min:2|max:10',
            //'avatar'=>'image',
           // 'password'=>'min:5',
            'password_confirmation'=>'same:password',
            'phone'=>'min:9',
            'address'=>'min:6'
        ],[
            'name.min'=>'Trường tên có độ dài từ 2-10 kí tự',
            'name.max'=>'Trường tên có độ dài từ 2-10 kí tự',
            //'avatar.image'=>'File ảnh không đúng định dạng',
            //'password.min'=>'Trường mật khẩu tối thiểu 5 kí tự',
            'password-confirmation.same'=>'Mật khẩu không trùng khớp',
        ]);
        $user=Auth::user();
        $arr['name']=$request->name;
        $arr['password']=bcrypt($request->password);
        $arr['numberPhone']=$request->phone;
        $arr['address']=$request->address;
        if($request->hasFile('avatar')){
            $filename=$request->avatar->getClientOriginalName();
           $arr['avatar']=$filename;
            $request->img->storeAs('customer',$filename);
        }
        $user::where('id',Auth::user()->id)->update($arr);

        return redirect('/user')->with('success','Sửa thành công');

    }
}
