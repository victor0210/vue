<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/8
 * Time: 11:41
 */

namespace App\Services;


use App\Helper\NotifyHelper;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class AuthService
{
    public function registerSuccess()
    {
        $this->create()->login()->notify(User::admins());
    }

    protected function create()
    {
        User::create([
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'password' => bcrypt(Input::get('password'))
        ]);

        return $this;
    }

    public function login()
    {
        Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password')]);

        return $this;
    }

    protected function notify(array $admins)
    {
        Auth::user()->notify(new Notify('欢迎来到论塘,如果有什么疑问请点击屏幕右下方的问好按钮,祝您在这里玩的愉快!'));
        foreach ($admins as $admin) {
            NotifyHelper::notify($admin->id, null, 'Member');
        }
    }
}