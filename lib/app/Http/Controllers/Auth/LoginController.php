<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\User;
use App\Category;
use App\Slide;
use Illuminate\Auth\SessionGuard;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $construct['cate']=Category::all();
        $construct['cate1']=Category::all();
        $construct['slide']=Slide::all();
        view()->share($construct);
    }
    public function redirectToGoogle()
    {

        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
           // dd($user);

            if($finduser){

                Auth::login(($finduser));
               return redirect('/');
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'avatar'=>$user->avatar,
                ]);
                Auth::login($newUser);
                return redirect('/');
            }
        } catch (Exception $e) {
            return redirect('auth/google');
        }
    }
    // protected function guard() // And now finally this is our custom guard name
    // {
    //     return Auth::guard('customers');
    // }
    public function postLogin(Request $request){
        $arr=['email'=>$request->email,'password'=>$request->password];
        if(Auth::attempt($arr)){
            return redirect('/');
        }
        else{
            return back()->withInput()->with('error','Đăng nhập thất bại');
        }
    }
    public function getLogin(){
        return view('homepage.auth.login');
    }
    public function getRegister(){
        return view('homepage.auth.register');
    }
    public function postRegister(Request $request){
        $this->validate($request,
        [
            'name'=>'required',
            'email'=>'required|unique:customers,cus_email',
            'password'=>'required',
            'password-confirm'=>'same:password',
            'phone'=>'required|min:9',
            'address'=>'required'
        ],
        [
            'email.required'=>'Bạn chưa nhập Email',
            'password-confirm.same'=>'Mật khẩu không trùng khớp'
        ]);
        $customers=new User();
        $customers->name=$request->name;
        $customers->email=$request->email;
        $customers->password=bcrypt($request->password);
        $customers->numberPhone=$request->phone;
        $customers->address=$request->address;
        $customers->save();
        return redirect('/login')->with('success','Đăng kí thành công, xin mời đăng nhập');
    }
}
