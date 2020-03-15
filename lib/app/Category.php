<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table="category";
    protected $primaryKey="cate_id";
    protected $guarded=[];

    public function product(){
        return $this->hasMany('App\Product','prod_cate','cate_id');
    }
}
