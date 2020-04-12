<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Slide;
use App\Blog;
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
        $data['cates']=Category::find($id);
        $data['product']=Product::where('prod_cate',$id)
        ->orderBy('prod_id','desc')
        ->paginate(10);
        return view('homepage.category.mobile',$data);
    }
    public function getBlog(){
        $data['blog']=Blog::all();
        $data['new']=DB::table('blogs')
        // ->where('blog_id',!null)
        ->orderBy('blog_id','desc')
        ->paginate(10);
        return view('homepage.category.news',$data);
    }

    public function getFeature(){
        $data['highlight_product']=DB::table('products')
        ->where('prod_feature',1)
        ->orderBy('prod_id','desc')
        ->paginate(10);
        return view('homepage.category.highlight-product',$data);
    }
    public function getNew(){
        $data['new_product']=DB::table('products')
        ->where('prod_condition','Mới 100%')
        ->orderBy('prod_id','desc')
        ->paginate(10);
        return view('homepage.category.new_product',$data);
    }
}
