<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Request;
use Validator;


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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $rules=['email'=>'required|email|exists:users','password'=>'required|min:6'];
        $message=[
            'email.required'=>'请填写邮箱',
            'email.email'=>'邮箱格式不正确',
            'email.exists'=>'邮箱未注册',
            'password.required'=>'请填写密码',
            'password.min'=>'密码至少为6位',
        ];
        $validator=Validator::make($request->input(),$rules,$message);
        if($validator->fails()){
            $token = $request->input() ? $request->header('X-CSRF-Token') : $request->input('_token');
            return Redirect::back()
                ->withErrors($validator)
                ->with($request->input());
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // 认证通过...
            return redirect('/');
        } else {
            return Redirect::back()
                ->withErrors(['password'=>'password would be wrong! check it']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function register()
    {
        return view('auth.register');
    }
}
