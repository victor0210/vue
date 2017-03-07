<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/6
 * Time: 21:51
 */

namespace App\Repositories;


use App\Models\Collection;

class CollectionRepository
{
    public function getByAsc()
    {
        return Collection::orderBy('id', 'asc')->get();
    }

    public function getActiveByAsc(){
        return Collection::where('is_active', 1)->orderBy('id', 'asc')->get();
    }

    public function getName($collection_id)
    {
        return Collection::where('id', $collection_id)->value('name');
    }

    public function getAllNames(){
        return Collection::orderBy('id', 'asc')->get()->pluck('name');
    }
}