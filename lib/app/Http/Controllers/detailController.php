<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Slide;
use App\Product;
use App\Blog;
use App\Comment;
use App\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class detailController extends Controller
{
    //
    public function __construct()
    {
        $construct['cate']=Category::all();
        $construct['cate1']=Category::all();
        $construct['slide']=Slide::all();
        view()->share($construct);
    }
    public function getProduct($id){
        $data['comment']=Comment::where('com_prod',$id)->orderBy('com_id','desc')->get();
        $data['product']=Product::FindorFail($id);
        $data['product_lq']=Product::where('prod_cate',$data['product']->prod_cate)
        ->orderBy('prod_id','desc')
        ->take(3)->get();

        $this->userID = Auth::user()?Auth::user()->id:null;
        $construct['cart1']=Cart::where('cart_user',$this->userID)->orderBy('cart_prod','desc')->get();
        $construct['prod1']=DB::table('cart')
        ->join('products','cart.cart_prod','=','products.prod_id')
        ->where('cart_user',$this->userID)
        ->orderBy('cart_id','desc')->get();
        if(empty($data['product']) || empty($data['product_lq'])){
            return view('homepage.errors.503',$construct);
        }
        return view('homepage.detail.mobile',$data,$construct);
    }
    public function postCommentProduct(Request $request, $id){
        $this->validate($request,
        [
            'comment'=>'required'
        ],
        [
            'comment.required'=>'Bạn chưa nhập nội dung bình luận'
        ]);

        $id_prod=$id;
        $comment=new Comment();
        $comment->com_user=Auth::user()->id;
        $comment->com_prod=$id_prod;
        $comment->com_content=$request->comment;
        $comment->save();

        return back()->with('comment','Đã bình luận thành công');

    }
    public function getBlog($id){
        $data['blog']=Blog::find($id);
        //$data['blog_lq']=$data['blog']->shift(5);
        $data['product_new']=DB::table('products')
        ->orderBy('prod_id','desc')
        ->take(4)->get();

        $data['product_new']=DB::table('products')
        ->orderBy('prod_id','desc')
        ->take(3)->get();
        $this->userID = Auth::user()?Auth::user()->id:null;
        $construct['cart1']=Cart::where('cart_user',$this->userID)->orderBy('cart_prod','desc')->get();
        $construct['prod1']=DB::table('cart')
        ->join('products','cart.cart_prod','=','products.prod_id')
        ->where('cart_user',$this->userID)
        ->orderBy('cart_id','desc')->get();

        $data['comment']=Comment::where('com_blog',$id)->orderBy('com_id','desc')->get();

        if(empty($data['blog']) || empty($data['product_new'])){
            return view('homepage.errors.503',$construct);
        }

        return view('homepage.detail.news',$data,$construct);
    }

    public function postCommentBlog(Request $request,$id){
        $this->validate($request,
        [
            'comment'=>'required'
        ],
        [
            'comment.required'=>'Bạn chưa nhập nội dung bình luận'
        ]);

        $id_blog=$id;
        $comment=new Comment();
        $comment->com_user=Auth::user()->id;
        $comment->com_blog=$id_blog;
        $comment->com_content=$request->comment;
        $comment->save();

        return back()->with('comment','Đã bình luận thành công');
    }

}
