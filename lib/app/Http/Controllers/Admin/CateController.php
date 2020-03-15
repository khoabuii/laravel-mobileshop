<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CateController extends Controller
{
    //
    public function getCate(){
        $data["cate_list"]=Category::all();

        return view('admin.category.category',$data);
    }
    public function postCate(Request $request){
        $this->validate($request,[
            'name'=>'unique:category,cate_name'

        ],[
            'name.unique'=>'Tên danh mục sản phẩm bị trùng'
        ]);
        $cate=new Category;
        $cate->cate_name=$request->name;
        $cate->cate_slug=str::slug($request->name);
        $cate->save();
        return back();
    }
    public function getEdit($id){
        $data['cate'] =Category::find($id);
        return view('admin.category.edit',$data);
    }
    public function postEdit(request $request,$id){
        $this->validate($request,
        [
            'name'=>'unique:category,cate_name',

        ],
        [
            'name.unique'=>'Tên danh mục bị trùng'
        ]);
        $cate=Category::find($id);
        $cate->cate_name=$request->name;
        $cate->cate_slug=str::slug($request->name);
        $cate->save();
        return redirect('admin/category')->with('suscess','Thao tác thành công');
    }
    public function getDelete($id){
        Category::destroy($id);
        return back();
    }
}
