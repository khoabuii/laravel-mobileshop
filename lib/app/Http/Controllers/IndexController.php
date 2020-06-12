<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Product;
use App\Slide;
use App\User;
use App\Feedback;
use App\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    //
    protected $userID;
    public function __construct()
    {
        $construct['cate']=Category::all();
        $construct['cate1']=Category::all();
        $construct['slide']=Slide::all();

        $this->userID = Auth::user()?Auth::user()->id:null;
        $construct['cart1']=Cart::where('cart_user',$this->userID)->orderBy('cart_prod','desc')->get();
        $construct['prod1']=DB::table('cart')
        ->join('products','cart.cart_prod','=','products.prod_id')
        ->where('cart_user',$this->userID)
        ->orderBy('cart_id','desc')->get();

        view()->share($construct);
    }

    public function getIndex(){
        $data['featured']=Product::where('prod_feature',1)
        ->orderBy('prod_id','desc')
        ->take(9)
        ->get();

        $data['new']=Product::where('prod_condition','Mới 100%')
        ->orWhere('prod_condition','Chính hãng')
        ->orderBy('prod_id','desc')
        ->take(10)
        ->get();

        $this->userID = Auth::user()?Auth::user()->id:null;
        $construct['cart1']=Cart::where('cart_user',$this->userID)->orderBy('cart_prod','desc')->get();
        $construct['prod1']=DB::table('cart')
        ->join('products','cart.cart_prod','=','products.prod_id')
        ->where('cart_user',$this->userID)
        ->orderBy('cart_id','desc')->get();

        return view('homepage.home',$data,$construct);
    }
    public function getLogout(){
        Auth::logout();
        return back();
    }
    public function getSearch(Request $request){
        $result=$request->result;
        $data['key']=$result;
        $result=str_replace(' ','%',$result);
        $data['search']=Product::where('prod_name','like','%'.$result.'%')->paginate(10);
        $data['count']=count($data['search']);

        $this->userID = Auth::user()?Auth::user()->id:null;
        $construct['cart1']=Cart::where('cart_user',$this->userID)->orderBy('cart_prod','desc')->get();
        $construct['prod1']=DB::table('cart')
        ->join('products','cart.cart_prod','=','products.prod_id')
        ->where('cart_user',$this->userID)
        ->orderBy('cart_id','desc')->get();
        return view('homepage.category.search',$data,$construct);
    }
    public function getFeedback(){
        $this->userID = Auth::user()?Auth::user()->id:null;
        $construct['cart1']=Cart::where('cart_user',$this->userID)->orderBy('cart_prod','desc')->get();
        $construct['prod1']=DB::table('cart')
        ->join('products','cart.cart_prod','=','products.prod_id')
        ->where('cart_user',$this->userID)
        ->orderBy('cart_id','desc')->get();
        return view('homepage.feedback',$construct);
    }

    public function postFeedback(Request $request){
        $this->validate($request,
        [
            'content'=>'required'
        ],
        [
            'content.required'=>'Vui lòng nhập nội dung'
        ]);

        $feed=new Feedback();
        $feed->feed_name=$request->name;
        $feed->feed_email=$request->email;
        $feed->feed_title=$request->title;
        $feed->feed_content=$request->content;
        $feed->save();

        return redirect('/')->with('script','Cảm ơn bạn đã góp ý');
    }
}
