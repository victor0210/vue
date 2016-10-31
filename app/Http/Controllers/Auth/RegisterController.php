<?php

namespace App\Http\Controllers\Auth;

use App\Mail\OrderShipped;
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
            'name' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required' => 'name is required',
            'name.max' => 'name is not validate',
            'name.unique' => 'name has been registed',
            'email.required' => 'email is required',
            'email.email' => '邮箱无效',
            'email.unique' => 'email has been registed',
            'password.reqire' => 'password is required and must over 6th',
            'password.confirmed' => 'passwords are diff in twice input',
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
        $validate = $this->validator($request->all());
        if ($validate->fails()) {
            return Redirect::back()
                ->withErrors($validate)
                ->withInput($request->input());
        } else {
//            if ($this->mail($request)) {
//            }
            $this->create($request->input());
            Auth::attempt(['email' => $request->email, 'password' => $request->password]);
            User::all()->searchable();
            return redirect('/');
        }
    }

    protected function mail(Request $request)
    {
        $activationcode = md5($request . time());
        Mail::to($request->email)->send(new OrderShipped(['email' => $request->email, 'activationcode' => $activationcode]));
    }
}
