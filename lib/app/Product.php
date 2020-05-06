<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table="products";
    protected $primaryKey="prod_id";
    protected $gradued=[];

    public function category(){
        return $this->belongsTo('App\Category','prod_cate','cate_id');
    }

    public function cart(){
        return $this->belongsToMany('App\Cart','cart_prod','prod_id');
    }

}
