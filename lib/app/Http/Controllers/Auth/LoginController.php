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
use App\Cart;
use Illuminate\Support\Facades\DB;
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
        $this->userID = Auth::user()?Auth::user()->id:null;
        $construct['cart1']=Cart::where('cart_user',$this->userID)->orderBy('cart_prod','desc')->get();
        $construct['prod1']=DB::table('cart')
        ->join('products','cart.cart_prod','=','products.prod_id')
        ->where('cart_user',$this->userID)
        ->orderBy('cart_id','desc')->get();
        return view('homepage.auth.login',$construct);
    }
    public function getRegister(){
        $this->userID = Auth::user()?Auth::user()->id:null;
        $construct['cart1']=Cart::where('cart_user',$this->userID)->orderBy('cart_prod','desc')->get();
        $construct['prod1']=DB::table('cart')
        ->join('products','cart.cart_prod','=','products.prod_id')
        ->where('cart_user',$this->userID)
        ->orderBy('cart_id','desc')->get();
        return view('homepage.auth.register',$construct);
    }
    public function postRegister(Request $request){
        $this->validate($request,
        [
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required|min:4|max:16',
            'password_confirmation'=>'same:password',
            'phone'=>'required|min:9',
            'address'=>'required'
        ],
        [
            'email.required'=>'Bạn chưa nhập Email',
            'password_confirmation.same'=>'Mật khẩu không trùng khớp'
        ]);
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->numberPhone=$request->phone;
        $user->address=$request->address;
        $user->save();

        return redirect('/login')->with('success','Đăng kí thành công, xin mời đăng nhập');
    }
}
