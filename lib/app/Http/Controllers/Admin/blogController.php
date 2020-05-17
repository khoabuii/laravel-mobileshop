<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Support\Facades\View;

class blogController extends Controller
{
    //
    public function getBlog(){
        $data['blogs']=Blog::all()->sortByDesc('blog_id');
        return view('admin.blog.blog',$data);
    }
    public function getAdd(){
        return view('admin.blog.add');
    }
    public function postAdd(Request $request){
        $this->validate($request,[
            'img'=>'image'
        ],
        [
            'img.image'=>'Hình ảnh không đúng định dạng'
        ]);
        $data=new Blog();
        $data->blog_title=$request->name;
        $data->blog_slug=str::slug($request->name);
        $data->blog_summary=$request->summary;
        $data->blog_content=$request->description;
        $data->blog_view=0;
        $filename=$request->img->getClientOriginalName();
        $data->blog_img=$filename;
        $data->save();

        $request->img->storeAs('blog',$filename);
        return redirect('admin/blog');

    }
    public function getEdit($id){
        $data['blogs']=Blog::find($id);
        return view('admin.blog.edit',$data);
    }
    public function postEdit(Request $request,$id){
        $this->validate($request,[
            'img'=>'image'
        ],
        [
            'img.image'=>'Hình ảnh không đúng định dạng'
        ]);
        $blog=new Blog();
        $arr['blog_title']=$request->name;
        $arr['blog_slug']=str::slug($request->name);
        $arr['blog_summary']=$request->summary;
        $arr['blog_view']=0;
        if($request->hasFile('img')){
            $filename=$request->img->getClientOriginalName();
            $arr['blog_img']=$filename;
            $request->img->storeAs('blog',$filename);
        }
        $blog::where('blog_id',$id)->update($arr);

        return redirect('admin/blog')->with('success','Đã sữa thành công');
    }

    public function getDelete($id){
        $data=Blog::destroy($id);
        return back()->with('success','Đã xóa thành công');
    }
    public function show($id){
        $data=Blog::find($id);
        Event::fire('blog.view',$data);

        return View::make('blogs.show')->withPosts($data);
    }
}
