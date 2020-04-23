<?php

namespace App\Http\Controllers\Admin;

use App\Feedback;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    //
    public function getHome(){
        return view('admin.index');
    }

    public function getCustomers(){
        $data['customers']=User::all();
        return view('admin.customer.customers',$data);
    }
    public function getDeleteCustomers($id){
        User::destroy($id);
        return back()->with('success','Đã xóa thành công');
    }
    public function getFeedback(){
        $data['feed']=Feedback::all();
        return view('admin.feedback',$data);
    }
    public function getFeedbackDelete($id){
        Feedback::destroy($id);
        return back()->with('success','Xóa thành công');
    }
}
