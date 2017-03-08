<?php

namespace App\Http\Controllers\Auth;

use App\Helper\ValidateHelper;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
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

    private $authService;

    /**
     * Create a new controller instance.
     *
     * @internal param AuthService $authService
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->authService=$authService;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = ValidateHelper::customValidate($request->input(), 'Login');
        if ($validator->fails()) {
//            $token = $request->input() ? $request->header('X-CSRF-Token') : $request->input('_token');
            ValidateHelper::redirect($validator, $request->input());
        }
        // 认证通过...
        $this->authService->login();
        return redirect('/');
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
