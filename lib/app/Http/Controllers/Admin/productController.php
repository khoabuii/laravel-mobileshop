<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class productController extends Controller
{
    //
    public function getProduct(){
        $data=Product::all();
        return view('admin.products.product',$data);
    }
    public function getAdd(){
        return view('admin.products.addproduct');
    }
}
