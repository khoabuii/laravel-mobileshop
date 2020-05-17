<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Slide;
use App\Blog;
use Illuminate\Support\Facades\Auth;
use App\Cart;
use Illuminate\Support\Facades\DB;

use stdClass;
class CateController extends Controller
{
    //
    public function __construct()
    {
        $construct['cate']=Category::all();
        $construct['cate1']=Category::all();
        $construct['slide']=Slide::all();

        view()->share($construct);
    }
    public function getCate($id){
        $this->userID = Auth::user()?Auth::user()->id:null;
        $construct['cart1']=Cart::where('cart_user',$this->userID)->orderBy('cart_prod','desc')->get();
        $construct['prod1']=DB::table('cart')
        ->join('products','cart.cart_prod','=','products.prod_id')
        ->where('cart_user',$this->userID)
        ->orderBy('cart_id','desc')->get();

        $data['cates']=Category::find($id);
        $data['product']=Product::where('prod_cate',$id)
        ->orderBy('prod_id','desc')
        ->paginate(10);
        if(empty($data['product']) || empty($data['cates'])){
            return view('homepage.errors.503',$construct);
        }
        return view('homepage.category.mobile',$data,$construct);
    }
    public function getBlog(){
        $data['blog']=Blog::all();
        $data['new']=DB::table('blogs')
        // ->where('blog_id',!null)
        ->orderBy('blog_id','desc')
        ->paginate(10);

        $this->userID = Auth::user()?Auth::user()->id:null;
        $construct['cart1']=Cart::where('cart_user',$this->userID)->orderBy('cart_prod','desc')->get();
        $construct['prod1']=DB::table('cart')
        ->join('products','cart.cart_prod','=','products.prod_id')
        ->where('cart_user',$this->userID)
        ->orderBy('cart_id','desc')->get();
        if(empty($data['blog']) || empty($data['new'])){
            return view('homepage.errors.503',$construct);
        }
        return view('homepage.category.news',$data,$construct);
    }

    public function getFeature(){
        $this->userID = Auth::user()?Auth::user()->id:null;
        $construct['cart1']=Cart::where('cart_user',$this->userID)->orderBy('cart_prod','desc')->get();
        $construct['prod1']=DB::table('cart')
        ->join('products','cart.cart_prod','=','products.prod_id')
        ->where('cart_user',$this->userID)
        ->orderBy('cart_id','desc')->get();

        $data['highlight_product']=DB::table('products')
        ->where('prod_feature',1)
        ->orderBy('prod_id','desc')
        ->paginate(10);
        return view('homepage.category.highlight-product',$data,$construct);
    }
    public function getNew(){
        $data['new_product']=DB::table('products')
        ->where('prod_condition','Mới 100%')
        ->orderBy('prod_id','desc')
        ->paginate(10);

        $this->userID = Auth::user()?Auth::user()->id:null;
        $construct['cart1']=Cart::where('cart_user',$this->userID)->orderBy('cart_prod','desc')->get();
        $construct['prod1']=DB::table('cart')
        ->join('products','cart.cart_prod','=','products.prod_id')
        ->where('cart_user',$this->userID)
        ->orderBy('cart_id','desc')->get();
        return view('homepage.category.new_product',$data,$construct);
    }
}
