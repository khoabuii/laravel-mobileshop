<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Product;
use App\Slide;
use App\Customer;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    //
    public function __construct()
    {
        $construct['cate']=Category::all();
        $construct['cate1']=Category::all();
        $construct['slide']=Slide::all();
        view()->share($construct);
    }

    public function getIndex(){
        $data['featured']=Product::where('prod_feature',1)
        ->orderBy('prod_id','desc')
        ->take(10)
        ->get();

        $data['new']=Product::where('prod_condition','Mới 100%')
        ->orderBy('prod_id','desc')
        ->take(10)
        ->get();

        return view('homepage.home',$data);
    }
    public function getLogout(){
        Auth::logout();
        return back();
    }
}
