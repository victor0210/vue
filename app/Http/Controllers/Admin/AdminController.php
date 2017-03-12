<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 9/30/16
 * Time: 22:08
 */

namespace App\Http\Controllers\Admin;


use App\Helper\ValidateHelper;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Collection;
use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index()
    {
        $Audits = Article::where('isValidated', false)->count();
        return view('admin.index', compact('Audits'));
    }

    public function create(Request $request)
    {
        $validate = ValidateHelper::customValidate($request->all(), 'Collection');
        if ($validate->fails()) {
            return ValidateHelper::redirect($validate, $request->input());
        }
        $this->adminService->uploadCollection($request->file('image')->getRealPath());
        return redirect('/admin/categories');
    }

    public function categoryAdd()
    {
        return view('admin.web.category.category-add');
    }

    public function category()
    {
        $collections = Collection::orderBy('id', 'asc')->get();
        return view('admin.web.category.category', compact('collections'));
    }

    public function categoryEdit($id)
    {
        $name = explode('.',Collection::where('id', $id)->value('name'))[0];
        return view('admin.web.category.category-edit', compact('name'));
    }

    public function categoryUploadImage(Request $request)
    {
        $validate = ValidateHelper::customValidate($request->all(), 'Collection_Change');
        if ($validate->fails()) {
            return ValidateHelper::redirect($validate);
        }
        $this->adminService->uploadCollection($request->file('image')->getRealPath());
        return redirect('/admin/categories');
    }
}
