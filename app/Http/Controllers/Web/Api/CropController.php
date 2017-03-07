<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/5
 * Time: 18:31
 */

namespace App\Http\Controllers\Web\Api;


use App\Http\Controllers\Controller;
use App\Services\ImageService;
use Illuminate\Http\Request;

class CropController extends Controller
{
    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function upload(Request $request)
    {
        return $this->imageService->upload($request);
    }

    public function size(Request $request)
    {
        $this->imageService->size($request);
        return redirect('/setting');
    }
}