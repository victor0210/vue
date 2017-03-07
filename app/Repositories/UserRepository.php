<?php
namespace App\Repositories;
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/6
 * Time: 20:15
 */
use App\User;
use Auth;

class UserRepository
{
    public function isAdmin(){
        return Auth::user()->isAdmin();
    }

    public function incrementBrowse($id){
        User::find($id)->increment('browse');
        return User::find($id);
    }

    public function admins(){
        return User::where('is_admin', '1')->get();
    }
}