<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Product;
use App\Slide;
use App\User;
use App\Feedback;
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
    public function getSearch(Request $request){
        $result=$request->result;
        $data['key']=$result;
        $result=str_replace(' ','%',$result);
        $data['search']=Product::where('prod_name','like','%'.$result.'%')->paginate(10);
        $data['count']=count($data['search']);
        return view('homepage.category.search',$data);
    }
    public function getFeedback(){
        return view('homepage.feedback');
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
