<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Slide;
use App\Product;
use App\Blog;
use App\Comment;
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
        $data['product']=Product::find($id);
        $data['product_lq']=Product::where('prod_cate',$data['product']->prod_cate)
        ->orderBy('prod_id','desc')
        ->take(3)->get();
        return view('homepage.detail.mobile',$data);
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

        $data['comment']=Comment::where('com_blog',$id)->orderBy('com_id','desc')->get();

        return view('homepage.detail.news',$data);
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
