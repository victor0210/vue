<?php

namespace App\Http\Controllers\Auth;

use App\Notifications\Member;
use App\Notifications\Notify;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:10|unique:users',
            'email' => 'required|email|max:30|unique:users',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required' => '用户名为必填项',
            'name.max' => '用户名最多为10位',
            'name.unique' => '该用户名已被注册',
            'email.required' => '邮箱为必填项',
            'email.email' => '邮箱无效',
            'email.unique' => '邮箱已被注册',
            'password.required' => '密码为必填项',
            'password.min' => '密码至少为6位',
            'password.confirmed' => '两次输入的密码不相同',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    protected function store(Request $request)
    {
        $admins = User::where('is_admin', '1')->get();
        $validate = $this->validator($request->all());
        if ($validate->fails()) {
            return Redirect::back()
                ->withErrors($validate)
                ->withInput($request->input());
        } else {
            $this->create($request->input());
            Auth::attempt(['email' => $request->email, 'password' => $request->password]);
            Auth::user()->searchable();
            Auth::user()->notify(new Notify('欢迎来到论塘,如果有什么疑问请点击屏幕右下方的问好按钮,祝您在这里玩的愉快!'));
            foreach ($admins as $admin) {
                $admin->notify(new Member(Auth::user()));
            }
            return redirect('/');
        }
    }

    protected function mail(Request $request)
    {
        $activationcode = md5($request . time());
        Mail::to($request->email)->send(new OrderShipped(['email' => $request->email, 'activationcode' => $activationcode]));
    }
}
