<?php

namespace App\Http\Service\Menu;

//use App\Http\Controllers\Admin\Topic\TopicController;
use App\Models\Menu;
use Illuminate\Support\Facades\Session;


class MenuService
{

    public function create($request)
    {
        try {
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => 0,
                'active' => (int) $request->input('active'),
            ]);
            Session::flash('success', 'Thêm  thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    public function addcate($request)
    {
        try {
            $menu_id = $request->input('menu_id');
            $cate_ids = $request->input('cate_id');
            if ($cate_ids === null) {
                Session::flash('error', 'Vui lòng chọn chủ đề');
                return false;
            } else {
                $menu = Menu::find($menu_id);
                foreach ($cate_ids as $cate) {
                    $menu->menu_category()->attach($cate);
                }
            }
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    public function getlist()
    {
        return Menu::orderBy('id')->get();
    }

    public function getlistactive()
    {
        return Menu::orderBy('id')->where('active', 1)->get();
    }

    public function update($menu, $request)
    {
        try {
            $menu->fill($request->input());
            $menu->save();
            Session::flash('success', 'Cập nhật thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    public function destroy($request)
    {
        try {
            $id = $request->input('id');
            //            $menutopic= Menu::find($id);
            //            $menutopic->menutopic()->detach();
            $menu = Menu::where('id', $id)->first();
            if ($menu) {
                Menu::where('id', $id)->orwhere('parent_id', $id)->delete();
            }
            Session::flash('success', 'Xóa thành công');
            return true;
        } catch (\Exception $err) {
            Session::flash('error', 'Xóa thất bại');
            return false;
        }
    }

    public function change_active($menu)
    {
        try {
            if ((int)$menu->active == 1) {
                $menu->active = 0;
                $menu->save();
                return true;
            } else {
                $menu->active = 1;
                $menu->save();
                return true;
            }
        } catch (\Exception $err) {
            Session::flash('error', 'Thất bại');
            return false;
        }
    }

    public function getmenuParent()
    {
        return Menu::where('parent_id', 0)->get();
    }

    public function getmenuspecial()
    {
        return Menu::where('parent_id', 27)->get();
    }

    public function getmenuchild()
    {
        return Menu::where('parent_id', '!=', 0)->get();
    }

    public function getid($id)
    {
        return Menu::where('id', $id)->where('active', 1)->firstOrFail();
    }

    public function getparentid($parent_id)
    {
        return Menu::where('id', $parent_id)->firstOrFail();
    }

    public function getchildid($id)
    {
        return Menu::where('parent_id', $id)->get();
    }
}
