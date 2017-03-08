<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use Searchable;
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'is_admin' => 'boolean'
    ];

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function comment()
    {
        return $this->hasMany('App\Models\Comment', 'user_id');
    }

    public function article()
    {
        return $this->hasMany('App\Models\Article');
    }

    public function records()
    {
        return $this->hasMany('App\Models\Records');
    }

    public function comment_replies()
    {
        return $this->hasMany('App\Models\Comment_Replies');
    }

    //helper api
    public static function admins()
    {
        return User::where('is_admin', 1)->get();
    }
}
