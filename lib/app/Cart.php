<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $table="cart";
    protected $primaryKey="cart_id";
    protected $guarded=[];

    public function user(){
        return $this->belongsToMany('App\User','id','cart_id');
    }
    public function product(){
        return $this->belongsToMany('App\Product','prod_id','cart_prod');
    }
}
