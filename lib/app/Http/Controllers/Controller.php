<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function method(Model $model, $route, $param, $view){
        $this->userID = Auth::user()?Auth::user()->id:null;
        $construct['cart']=Cart::where('cart_user',$this->userID)->orderBy('cart_prod','desc')->get();
        $construct['prod']=DB::table('cart')
        ->join('products','cart.cart_prod','=','products.prod_id')
        ->orderBy('cart_id','desc')->get();

        return view($view);
    }
}
