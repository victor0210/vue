<?php
namespace App\Services;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/7
 * Time: 21:56
 */
class ImageService
{
    private $img;

    public function upload($request){
        $this->deleteTempFile($request);
        $filename = md5($request->user()->email) . random_int(0, 999999999999999) . '.png';
        $this->saveTempFile($filename,$request->file('img'));
        $request->session()->put('avatar_temp', $filename);
        return asset(Storage::url("public/temp/" . $filename));
    }

    protected function saveTempFile($filename,$file){
        $path = storage_path('app/public/temp/'.$filename);
        $this->img = Image::make(file_get_contents($file->getRealPath()));
        $this->resize()->save($path);
    }
    protected function resize()
    {
        $w = $this->img->width();
        $h = $this->img->height();
        if ($w >= $h) {
            $this->img->resize(300, $h * 300 / $w);
        } else {
            $this->img->resize($w * 300 / $h, 300);
        }
        return $this->img;
    }


    public function size($request)
    {
        if ($request->x != '') {
            $filename = $request->user()->email . random_int(0, 999999999999999) . '.png';
            $path = storage_path('app/public/avatar/') . $filename;
            $this->img = Image::make(file_get_contents(storage_path('app/public/temp/'.$request->session()->get('avatar_temp'))));
            $this->deleteOldAvatar();
            $this->img->crop($request->w, $request->h, $request->x, $request->y)->save($path);
            $url = asset(Storage::url("public/avatar/" . $filename));
            User::where('id', $request->user()->id)->update(['avatar_url' => $url]);
            $this->deleteTempFile($request);
        }
        return redirect('/setting');
    }

    protected function deleteOldAvatar()
    {
        $filename = explode('/', Auth::user()->avatar_url)[count(explode('/', Auth::user()->avatar_url))-1];
        if (Storage::disk('avatar')->exists($filename))
            Storage::disk('avatar')->delete($filename);
    }

    protected function deleteTempFile($request)
    {
        if ($request->session()->has('avatar_temp')) {
            Storage::disk('temp')->delete($request->session()->get('avatar_temp'));
        }
    }

}