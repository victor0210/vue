<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2016/10/20
 * Time: 21:20
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = ['name', 'image'];

    public function isActive()
    {
        return $this->is_active;
    }
}