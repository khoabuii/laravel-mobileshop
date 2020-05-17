<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class productController extends Controller
{
    //
    public function getProduct(){
        $data['product']=DB::table('products')
        ->join('category','products.prod_cate','=','category.cate_id')
        ->orderBy('prod_id','desc')->get();
        return view('admin.products.product',$data);
    }
    public function getAdd(){
        $data['category']=Category::all();
        return view('admin.products.addproduct',$data);
    }
    public function postAdd(Request $request){
        $this->validate($request,[
            'img'=>'image'
        ],
        [
            'img.image'=>'Hình ảnh không đúng định dạng'
        ]);
        $product=new Product;
        $product->prod_name=$request->name;
        $product->prod_slug=str::slug($request->name);
        $product->prod_price=$request->price;
        $product->prod_promotion_price=$request->promotion_price;
        $product->prod_promotion=$request->promotion;
        $product->prod_warranty=$request->warranty;
        $product->prod_accessories=$request->accessories;
        $product->prod_condition=$request->condition;
        $product->prod_status=$request->status;
        $product->prod_description=$request->description;
        $product->prod_feature=$request->featured;
        $product->prod_cate=$request->cate;
        $filename=$request->img->getClientOriginalName();
        $product->prod_img=$filename;

        $product->save();
        $request->img->storeAs('avatar',$filename);
        return redirect('admin/product')->with('success','Đã thêm sản phẩm');
    }

    public function getDelete($id){
        Product::destroy($id);
        return back();
    }
    public function getEdit($id){
        $data['category']=Category::all();
        $data['product']=Product::find($id);
        return view('admin.products.editproduct',$data);
    }
    public function postEdit(Request $request ,$id){
        $this->validate($request,[
            'img'=>'image'
        ],
        [
            'img.image'=>'Hình ảnh không đúng định dạng'
        ]);
        $product=new Product;
        $arr['prod_name']=$request->name;
        $arr['prod_slug']=str::slug($request->name);
        $arr['prod_price']=$request->price;
        $arr['prod_promotion_price']=$request->promotion_price;
        $arr['prod_promotion']=$request->promotion;
        $arr['prod_warranty']=$request->warranty;
        $arr['prod_accessories']=$request->accessories;
        $arr['prod_condition']=$request->condition;
        $arr['prod_status']=$request->status;
        $arr['prod_description']=$request->description;
        $arr['prod_feature']=$request->featured;
        $arr['prod_cate']=$request->cate;

        if($request->hasFile('img')){
            $filename=$request->img->getClientOriginalName();
            $arr['prod_img']=$filename;
            $request->img->storeAs('avatar',$filename);
        }
        $product::where('prod_id',$id)->update($arr);

        return redirect('admin/product')->with('success','Sửa thành công');
    }

}
