<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/8
 * Time: 10:21
 */

namespace App\Services;


use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class AdminService
{
    private $collectionService;

    public function __construct(CollectionService $collectionService)
    {
        $this->collectionService=$collectionService;
    }

    public function uploadCollection($file)
    {
        $name = Input::get('name');
        $filename = $name . '.jpg';
        $url = $this->saveCollection($filename, $file);
        $this->collectionService->save($name,$url);
    }

    protected function saveCollection($filename, $file)
    {
        Storage::disk('collection')->put($filename, file_get_contents($file->getRealPath()));
        return asset(Storage::url("public/collection/" . $filename . '.jpg'));
    }
}