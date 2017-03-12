<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/8
 * Time: 10:28
 */

namespace App\Services;


use App\Models\Collection;

class CollectionService
{
    public function getByAsc()
    {
        return Collection::orderBy('id', 'asc')->get();
    }

    public function getActiveByAsc()
    {
        return Collection::where('is_active', 1)->orderBy('id', 'asc')->get();
    }

    public function getName($collection_id)
    {
        return Collection::where('id', $collection_id)->value('name');
    }

    public function getAllNames()
    {
        return Collection::orderBy('id', 'asc')->get()->pluck('name');
    }

    public function save($name, $url)
    {
        if (Collection::where('name', $name)->get()->isEmpty()) {
            Collection::create([
                'name' => $name,
                'image' => $url,
                'created_at' => gmdate('Y-m-d H:i:s'),
                'updated_at' => gmdate('Y-m-d H:i:s')
            ]);
        } else {
            Collection::where('name', $name)->update(['image' => $url]);
        }
    }
}