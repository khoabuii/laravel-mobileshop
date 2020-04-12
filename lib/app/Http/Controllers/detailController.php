<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Slide;
use App\Product;
use App\Blog;
use Illuminate\Support\Facades\DB;

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
        $data['product']=Product::find($id);
        $data['product_lq']=Product::where('prod_cate',$data['product']->prod_cate)
        ->orderBy('prod_id','desc')
        ->take(3)->get();
        return view('homepage.detail.mobile',$data);
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

        return view('homepage.detail.news',$data);
    }
}
