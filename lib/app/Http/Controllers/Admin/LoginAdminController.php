<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAdminController extends Controller
{
    //
    public function getLogin(){
        return view("admin.login");
    }
    public function postLogin(Request $request){
        $email=$request->email;
        $password=$request->password;
        if(Auth::attempt(['email' => $email, 'password' => $password])){
           return redirect('admin/home');
        }else
            return back()->with("Đăng nhập thất bại");
    }
    public function getLogout(){
        Auth::logout();
        return redirect('admin/login');
    }
}
