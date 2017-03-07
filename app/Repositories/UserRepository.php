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
use Illuminate\Support\Facades\Input;

class UserRepository
{
    private $user;

    public function __construct()
    {
        $this->user=Auth::user();
    }

    public function isAdmin(){
        return $this->user->isAdmin();
    }

    public function incrementBrowse($id){
        User::find($id)->increment('browse');
        return User::find($id);
    }

    public function admins(){
        return User::where('is_admin', '1')->get();
    }

    public function updateDescription(){
        User::find($this->user->id)->update(['description' => Input::get('description')]);
    }
}