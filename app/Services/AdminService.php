<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/8
 * Time: 10:21
 */

namespace App\Services;


use App\Repositories\CollectionRepository;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class AdminService
{
    private $collectionRepository;

    public function __construct(CollectionRepository $collectionRepository)
    {
        $this->collectionRepository=$collectionRepository;
    }

    public function uploadCollection($file)
    {
        $name = Input::get('name');
        $filename = $name . '.jpg';
        $url = $this->saveCollection($filename, $file);
        $this->collectionRepository->save($name,$url);
    }

    protected function saveCollection($filename, $file)
    {
        Storage::disk('collection')->put($filename, file_get_contents($file->getRealPath()));
        return asset(Storage::url("public/collection/" . $filename . '.jpg'));
    }
}