<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //
    protected $table="blogs";
    protected $primaryKey="blog_id";
    protected $guarded=[];

    protected $fillable=['blog_title','blog_content'];
}
