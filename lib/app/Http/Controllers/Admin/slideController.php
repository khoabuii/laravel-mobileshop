<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Slide;
use Illuminate\Foundation\Console\Presets\React;
use Illuminate\Http\Request;

class slideController extends Controller
{
    //
    public function getSlide(){
        $data['slides']=Slide::all()->sortByDesc('slide_id');
        return view('admin.slide.slide',$data);
    }
    public function getAdd(){
        return view('admin.slide.add');
    }
    public function postAdd(Request $request){
        $this->validate($request,
        [
            'img'=>'image'
        ],[
            'img.image'=>'Hình ảnh không đúng định dạng'
        ]);
        $data=new Slide();
        $data->slide_name=$request->name;
        $data->slide_link=$request->link;

        $data->status=$request->status;
        $filename=$request->img->getClientOriginalName();
        $data->slide_img=$filename;

        $data->save();
        $request->img->storeAs('slide',$filename);
        return redirect('admin/slide')->with('success','Thêm slide thành công');
    }

    public function getEdit($id){
        $data['slide']=Slide::find($id);
        return view('admin.slide.edit',$data);
    }
    public function postEdit(Request $request,$id){
        $data=new Slide();
        $arr['slide_name']=$request->name;
        $arr['slide_link']=$request->link;
        $arr['status']=$request->status;
        if($request->hasFile('img')){
            $filename=$request->img->getClientOriginalName();
            $arr['img']=$filename;
            $request->img->storeAs('slide',$filename);
        }
        $data::where('slide_id',$id)->update($arr);


        return redirect('admin/slide')->with('success','Sửa thành công');
    }

    public function getDelete($id){
        $data=Slide::destroy($id);
        return back()->with('success','Deleted');
    }
}
