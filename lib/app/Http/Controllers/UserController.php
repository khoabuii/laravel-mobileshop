<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Slide;
use App\Cart;
use App\Bill;
use Illuminate\Support\Facades\DB;
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
        $this->userID = Auth::user()?Auth::user()->id:null;
        $construct['cart1']=Cart::where('cart_user',$this->userID)->orderBy('cart_prod','desc')->get();
        $construct['prod1']=DB::table('cart')
        ->join('products','cart.cart_prod','=','products.prod_id')
        ->where('cart_user',$this->userID)
        ->orderBy('cart_id','desc')->get();

        if(Auth::user()){
            $data['bill']=Bill::where('bill_user',$this->userID)
            ->orderBy('bill_id','desc')->get();
            return view('homepage.member.user',$construct,$data);
        }
        else
            return redirect('/');
    }
    //cancel bill
    public function getCancelBill($id){
        $bill= new Bill();
        $arr['bill_status']=3;
        $bill::where('bill_id',$id)->update($arr);
        return back();
    }
    public function getUserEdit(){
        $this->userID = Auth::user()?Auth::user()->id:null;
        $construct['cart1']=Cart::where('cart_user',$this->userID)->orderBy('cart_prod','desc')->get();
        $construct['prod1']=DB::table('cart')
        ->join('products','cart.cart_prod','=','products.prod_id')
        ->where('cart_user',$this->userID)
        ->orderBy('cart_id','desc')->get();
        return view('homepage.member.edit',$construct);
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
