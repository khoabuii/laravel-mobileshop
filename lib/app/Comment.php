<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table="comments";
    protected $primaryKey="com_id";
    protected $gradued=[];

    public function user(){
        return $this->belongsTo('App\User','com_user','id');
    }
}
