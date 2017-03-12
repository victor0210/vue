<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/7
 * Time: 22:39
 */

namespace App\Services;


use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class UserService
{
    public function search($query){
        $users = User::search($query)->get();
        if ($users->count() == 0) {
            $users = User::get();
        }
        return $users;
    }

    public function timezoneFormat($users){
        foreach ($users as $user) {
            $user->created_at->timezone('Asia/Chongqing');   //set time zone in Chongqing
        }
        return $users;
    }

    public function incrementBrowse($id){
        User::find($id)->increment('browse');
        return User::find($id);
    }

    public function admins(){
        return User::where('is_admin', '1')->get();
    }

    public function updateDescription(){
        User::where('id',Auth::user()->id)->update(['description' => Input::get('description')]);
    }
}