<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use App\Category;
use App\Comment;
use App\Feedback;
use App\Http\Controllers\Controller;
use App\Product;
use App\Slide;
use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    //
    public function getHome(){
        $data['product']=Product::all();
        $data['prod_count']=count($data['product']);

        $data['comment']=Comment::all();
        $data['com_count']=count($data['comment']);

        $data['users']=User::all();
        $data['count_users']=count($data['users']);

        $data['blog']=Blog::all();
        $data['count_blog']=count($data['blog']);

        $data['cate']=Category::all();
        $data['count_cate']=count($data['cate']);

        $data['slide']=Slide::all();
        $data['count_slide']=count($data['slide']);
        return view('admin.index',$data);
    }

    public function getCustomers(){
        $data['customers']=User::all();
        return view('admin.customer.customers',$data);
    }
    public function getDeleteCustomers($id){
        User::destroy($id);
        return back()->with('success','Đã xóa thành công');
    }
    public function getFeedback(){
        $data['feed']=Feedback::all();
        return view('admin.feedback',$data);
    }
    public function getFeedbackDelete($id){
        Feedback::destroy($id);
        return back()->with('success','Xóa thành công');
    }
}
