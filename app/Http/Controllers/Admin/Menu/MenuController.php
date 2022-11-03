<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\MenuCreateFormRequest;
use App\Http\Service\Category\CategoryService;
use App\Http\Service\Menu\MenuService;
use App\Models\Menu;
use Illuminate\Http\Request;


class MenuController extends Controller
{
    protected $menuservice;
    protected $cateservice;


    public function __construct(MenuService $menuService,CategoryService $categoryService)
    {
        $this->menuservice = $menuService;
        $this->cateservice=$categoryService;
    }

    public function create(){
        return view('admin.menu.add',[
            'title'=>'Danh Mục',
//            'menu_parent' => $this->menuservice->getmenuParent(),
            'menus'=> $this->menuservice->getlist(),
            'var'=>0
        ]);
    }


    public function store(MenuCreateFormRequest $request){
        $this->menuservice->create($request);
        return redirect()->back();
    }

    public function addcate(){
        return view('admin.menu.addcate',[
            'title'=>'Thể Loại Của Danh Mục',
            'menus'=> $this->menuservice->getlistactive(),
            'cates'=>$this->cateservice->getlistactive(),
            'var'=>0
        ]);
    }

    public function storecate(Request $request){
        $this->menuservice->addcate($request);
        return redirect()->back();
    }

    public function editcate(Menu $menu){
        $idmenu=$menu->id;
        return view('admin.menu.addcate',[
            'title'=>'Sửa Thể Loại Cho Danh Mục '. $menu->name,
            'menus'=> $this->menuservice->getlistactive(),
            'menucate'=> $menu,
            'cates'=>$this->cateservice->getlistactive(),
            'var'=>1
        ]);
    }

    public function updatecate(Menu $menu,Request $request){
        $idmenu=$menu->id;
        $this->cateservice->updatecate($idmenu,$request);
        return redirect('/admin/menu/addcate');
    }


    public function edit(Menu $menu){
        return view('admin.menu.add',[
            'title'=>'Sửa Danh Mục: ' . $menu->name ,
            'menu' => $menu,
            'menu_parent' => $this->menuservice->getmenuParent(),
            'menus' => $this->menuservice->getlist(),
            'var'=>1
        ]);
    }

    public function update(Menu $menu, MenuCreateFormRequest $request){
        $result=$this->menuservice->update($menu,$request);
        if($result)
            return redirect('admin/menu/add');
        else
            return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $result = $this->menuservice->destroy($request);
        if ($result===false)
            return response()->json([
                'error'=> true
            ]);
        else
            return response()->json([
                'error'=> false
            ]);
    }

    public function change_active(Menu $menu)
    {
        $result = $this->menuservice->change_active($menu);
        if ($result===false)
            return response()->json([
                'error'=> true,
                'active'=>$menu->active
            ]);
        else
            return response()->json([
                'error'=> false,
                'active'=>$menu->active,
                'id'=>$menu->id
            ]);
    }
}
