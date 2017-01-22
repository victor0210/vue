<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 9/30/16
 * Time: 22:08
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Validator;

class AdminController extends Controller
{
    public function index()
    {
        $Audits=Article::where('isValidated',false)->count();
        return view('admin.index',compact('Audits'));
    }

    protected function validator(array $data, $rules, $messages)
    {
        return Validator::make($data, $rules, $messages);
    }

    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|max:20|unique:collections',
            'image' => 'required',
        ];
        $messages = [
            'name.required' => 'name is required',
            'name.max' => 'name is max 20 characters',
            'name.unique' => 'collection name has been added before !',
            'image.required' => 'image must be required'
        ];
        $validate = $this->validator($request->all(), $rules, $messages);
        if ($validate->fails()) {
            return Redirect::back()
                ->withErrors($validate)
                ->withInput($request->input());
        } else {
            $name = $request->input('name');
            $filename = $name . '.jpg';
            Storage::disk('collection')->put($filename, file_get_contents($request->file('image')->getRealPath()));
            $url = asset(Storage::url("public/collection/" . $name . '.jpg'));
            Collection::create([
                'name' => $name,
                'image' => $url,
                'created_at' => gmdate('Y-m-d H:i:s'),
                'updated_at' => gmdate('Y-m-d H:i:s')
            ]);
            return redirect('/admin/categories');
        }
    }

    public function categoryAdd()
    {
        return view('admin.web.category.category-add');
    }

    public function category()
    {
        $collections = Collection::orderBy('id','asc')->get();
        return view('admin.web.category.category', compact('collections'));
    }

    public function categoryEdit($id)
    {
        $name = Collection::where('id', $id)->value('name');
        return view('admin.web.category.category-edit', compact('name'));
    }

    public function categoryUploadImage(Request $request)
    {
        $rules = ['image' => 'required'];
        $messages = ['images.required' => 'Image must be required'];
        $validate = Validator::make($request->all(), $rules, $messages);
        if ($validate->fails()) {
            return Redirect::back()
                ->withErrors($validate);
        } else {
            $name = $request->input('name');
            $filename = $name . '.jpg';
            Storage::disk('collection')->put($filename, file_get_contents($request->file('image')->getRealPath()));
            $url = asset(Storage::url("public/collection/" . $name . '.jpg'));
            Collection::where('name', $name)->update(['image' => $url]);
            return redirect('/admin/categories');
        }
    }
}
