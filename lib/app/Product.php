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

}
