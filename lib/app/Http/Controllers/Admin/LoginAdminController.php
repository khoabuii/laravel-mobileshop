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
        $arr=['email'=>$request->email,'password'=>$request->password];
        if(Auth::guard('admin')->attempt($arr)){
            return redirect('admin/home');
        }
        else{
            return back()->withInput()->with('error','Đăng nhập thất bại');
        }
    }
    public function getLogout(Request $request){
        Auth::guard('admin')->logout();
        if (!Auth::check() && !Auth::guard('admin')->check()) {
            $request->session()->flush();
            $request->session()->regenerate();
        }
        return redirect('admin/login');
    }
}
