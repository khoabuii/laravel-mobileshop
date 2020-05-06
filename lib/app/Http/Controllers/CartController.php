<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Slide;
use App\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\UnionType;
use Illuminate\Support\Collection;

class CartController extends Controller
{
    //
    public function __construct()
    {
        $construct['cate']=Category::all();
        $construct['cate1']=Category::all();
        $construct['slide']=Slide::all();

        $this->userID = Auth::user()?Auth::user()->id:null;
        $construct['cart1']=Cart::where('cart_user',$this->userID)->orderBy('cart_prod','desc')->get();
        $construct['prod1']=DB::table('cart')
        ->join('products','cart.cart_prod','=','products.prod_id')
        ->where('cart_user',$this->userID)
        ->orderBy('cart_id','desc')->get();

        view()->share($construct);
    }
    public function getCart(){
        $this->userID = Auth::user()?Auth::user()->id:null;
        $data['cart']=Cart::where('cart_user',$this->userID)->orderBy('cart_prod','desc')->get();
        $data['prod']=DB::table('cart')
        ->join('products','cart.cart_prod','=','products.prod_id')
        ->where('cart_user',$this->userID)
        ->orderBy('cart_id','desc')->get();

        $data['total']=$data['prod']->

        $data['count']=(count($data['prod']));


        return view('homepage.detail.cart',$data);
    }

    public function getAdd($id){
        try{
            if(Auth::user()){
            $id_prod=$id;
            $cart=new Cart();
            $cart->cart_user=Auth::user()->id;
            $cart->cart_prod=$id_prod;
            $uq=Cart::where('cart_user',Auth::user()->id)->where('cart_prod',$id_prod)->get();
            if(count($uq)>0){
                // $i=DB::select('select cart_quantity from cart where cart_user
                // = :cart_user' ,
                //  ['cart_user'=>Auth::user()->id]);
                // $j=DB::select('select cart_quantity from cart where cart_prod
                //  = :cart_prod' ,
                //   ['cart_prod'=>$id_prod]);
                $i=DB::table('cart')->select('cart_quantity')->where('cart_prod',$id_prod);
                $j=DB::table('cart')->select('cart_quantity')
                ->where('cart_user',Auth::user()->id)->union($i)
                ->first();
                //echo $j->cart_quantity;
                // $result=(int)$j+1;
                // dd($result);
                DB::table('cart')->where('cart_user',Auth::user()->id)
                ->where('cart_prod',$id_prod)
                ->update(['cart_quantity'=>$j->cart_quantity+1]); //chua xong
                return back(); //con loi
            }
            else{
                $cart->cart_quantity=1;
            }
            $cart->save();
            return back();
        }
        else{
            return redirect('login/');
        }

    }catch(Exception $e){
           return redirect('/');
        }

    }
    public function getDeleteAllUser($id){
        DB::table('cart')->where('cart_user',$id)->delete();
        return back();
    }
}
