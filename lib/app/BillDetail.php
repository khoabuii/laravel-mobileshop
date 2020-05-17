<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    //
    protected $table="billsdetail";
    protected $primarykey="detail_id";
    protected $guarded=[];

    public function bill(){
       return $this->belongsTo('App\Bill','bill_id','bill_id');
    }
}
