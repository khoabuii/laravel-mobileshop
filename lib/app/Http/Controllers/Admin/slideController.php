<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class slideController extends Controller
{
    //
    public function getSlide(){
        return view('admin.slide.slide');
    }
}
