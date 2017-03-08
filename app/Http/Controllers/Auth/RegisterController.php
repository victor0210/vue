<?php

namespace App\Http\Controllers\Auth;

use App\Helper\ValidateHelper;
use App\Services\AuthService;
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

    private $authService;

    /**
     * Create a new controller instance.
     *
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->middleware('guest');

        $this->authService=$authService;
    }


    protected function store(Request $request)
    {
        $validate = ValidateHelper::customValidate($request->all(), 'Register');
        if ($validate->fails()) {
            return ValidateHelper::redirect($validate, $request->input());
        }
        $this->authService->registerSuccess();
        return redirect('/');

    }
}
