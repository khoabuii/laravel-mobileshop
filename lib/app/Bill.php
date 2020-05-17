<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    //
    protected $table="bills";
    protected $primaryKey="bill_id";
    protected $guarded=[];

    public function billdetail(){
       return $this->hasMany('App\BillDetail','detail_id','bill_id');
    }

    public function user(){
        return $this->belongsTo('App\User','bill_user','id');
    }
}
