<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Service\Category\CategoryService;
use App\Http\Service\Menu\MenuService;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;
    protected $menuservice;

    public function __construct(CategoryService $categoryService,MenuService $menuService)
    {
        $this->category = $categoryService;
        $this->menuservice = $menuService;
    }

    public function create(){
        return view('admin.category.add',[
            'title'=>'Thể Loại',
            'cgory'=> $this->category->getlist(),
            'menus'=>$this->menuservice->getlist(),
            'var'=>0
        ]);
    }

    public function store(Request $request){
        $this->category->create($request);
        return redirect()->back();
    }

    public function edit(Category $category){
        return view('admin.category.add',[
            'title'=>'Sửa Thể Loại: ' . $category->name,
            'category' => $category,
            'cgory' => $this->category->getlist(),
            'menus'=>$this->menuservice->getlist(),
            'var'=>1
        ]);
    }

    public function update(Category $category, Request $request){
        $result=$this->category->update($category,$request);
        if($result)
            return redirect('admin/category/add');
        else
            return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $result = $this->category->destroy($request);
        if ($result===false)
            return response()->json([
                'error'=> true
            ]);
        else
            return response()->json([
                'error'=> false
            ]);
    }

    public function change_active(Category $category)
    {
        $result = $this->category->change_active($category);
        if ($result===false)
            return response()->json([
                'error'=> true,
                'active'=>$category->active
            ]);
        else
            return response()->json([
                'error'=> false,
                'active'=>$category->active,
                'id'=>$category->id
            ]);
    }
}
