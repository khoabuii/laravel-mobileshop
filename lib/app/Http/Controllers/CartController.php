<?php

namespace App\Http\Controllers;

use App\Bill;
use App\BillDetail;
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

        $data['product_lq']=Product::where('prod_cate',4)
        ->orderBy('prod_id','desc')
        ->take(3)->get();

        $sum=0;
        foreach($data['prod'] as $prod=>$value){
            $data['count']=(count($data['prod']));
            $quantity=$value->cart_quantity;
            if($value->prod_promotion_price != null)
                $total= ($quantity * $value->prod_promotion_price);
            else
                $total= ($quantity * $value->prod_price);
            $sum += $total;
        }


        $data['count']=(count($data['prod']));
        return view('homepage.detail.cart',$data,['sum'=>$sum]);
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
                $i=DB::table('cart')->select('cart_quantity')->where('cart_prod',$id_prod);
                $j=DB::table('cart')->select('cart_quantity')
                ->where('cart_user',Auth::user()->id)->union($i)
                ->first();
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
    public function getCheckout(){
        $this->userID = Auth::user()?Auth::user()->id:null;
        $data['cart']=Cart::where('cart_user',$this->userID)->orderBy('cart_prod','desc')->get();
        $data['prod']=DB::table('cart')
        ->join('products','cart.cart_prod','=','products.prod_id')
        ->where('cart_user',$this->userID)
        ->orderBy('cart_id','desc')->get();
        $data['count']=(count($data['prod']));
        $sum=0;
        foreach($data['prod'] as $prod=>$value){
            $data['count']=(count($data['prod']));
            $quantity=$value->cart_quantity;
            if($value->prod_promotion_price != null)
                $total= ($quantity * $value->prod_promotion_price);
            else
                $total= ($quantity * $value->prod_price);
            $sum += $total;
        }

        return view("homepage.detail.order",$data,['sum'=>$sum]);
    }
    public function getDeleteCart($id){
        Cart::destroy($id);
        return back();
    }
    public function postCheckout(Request $request){
        $this->userID = Auth::user()?Auth::user()->id:null;
        $data['cart']=Cart::where('cart_user',$this->userID)->orderBy('cart_prod','desc')->get();
        $data['prod']=DB::table('cart')
        ->join('products','cart.cart_prod','=','products.prod_id')
        ->where('cart_user',$this->userID)
        ->orderBy('cart_id','desc')->get();
        $data['count']=(count($data['prod']));
        $sum=0;
        foreach($data['prod'] as $prod=>$value){
            $data['count']=(count($data['prod']));
            $quantity=$value->cart_quantity;
            if($value->prod_promotion_price != null)
                $total= ($quantity * $value->prod_promotion_price);
            else
                $total= ($quantity * $value->prod_price);
            $bill_total=$sum += $total;

        }

        $bill=new Bill();
        $bill->bill_user=Auth::user()->id;
        $bill->bill_total=$bill_total;
        $bill->bill_address=$request->address;
        $bill->bill_status=0;
        $bill->bill_phone=$request->phone;
        $bill->bill_note=$request->note;
        $bill->save();

        foreach($data['prod'] as $prod){
            $bill_detail=new BillDetail();
            $bill_detail->bill_id=$bill->bill_id;
            $bill_detail->prod_name=$prod->prod_name;

            if($prod->prod_promotion_price != null){
                $bill_detail->prod_price=$prod->prod_promotion_price;
            }else{
                $bill_detail->prod_price=$prod->prod_price;
            }
            $bill_detail->quantity=$prod->cart_quantity;
            $bill_detail->save();
        }
        DB::table('cart')->where('cart_user',$this->userID)->delete();
        return redirect('/')->with('order','iiii');
    }
    public function getUpdateCartPlus($id){
        $update=Cart::FindorFail($id);
        $update->cart_quantity++;
        $update->save();
        return back();
    }
    public function getUpdateCartReduct($id){
        $update=Cart::FindorFail($id);
        $update->cart_quantity--;
        if($update->cart_quantity==0){
            Cart::destroy($id);
        }
        $update->save();
        return back();
    }
}
