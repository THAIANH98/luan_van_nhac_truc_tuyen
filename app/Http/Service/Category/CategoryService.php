<?php

namespace App\Http\Service\Category;

use App\Http\Service\Song\SongService;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Song;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoryService
{

    protected $songservice;

    public function __construct(SongService $songService)
    {
        $this->songservice = $songService;
    }

    public function create($request){
        try{
            Category::create($request->input());
//            $idCategory = Category::limit(1)->orderByDesc('id')->get();
//
//            $idCategory = $idCategory[0]->id;
//            $category = Category::find($idCategory);
//            $category->category_menu()->attach($request->input('menu_id'));

            Session::flash('success','Thêm  thành công');

        }catch (\Exception $err){
//            Category::where('id',$idCategory)->delete();
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }

    public function getlist(){
        return Category::orderBy('id')->get();
    }

    public function getlistactive(){
        return Category::orderBy('id')->where('active',1)->get();
    }
//
//    public function getID($category_id){
//        return Category::where('id',$category_id)->get();
//    }

    public function update($category,$request){
        try {
            $category->fill($request->input());
            $category->save();
            Session::flash('success','Cập nhật thành công');
        }catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }


    public function updatecate($idmenu,$request){
        $menu= Menu::find($idmenu);
        $menu->menu_category()->detach();
        if ($request->input('cate_id')!==null)
            foreach ($request->input('cate_id') as $cate){
                $menu->menu_category()->attach($cate);
            };
    }

    public function destroy($request){
        try {
            $id = $request->input('id');
            $menu = Category::find($id);
            $topicx= Category::where('id',$id)->first();
            if($topicx){
                $menu->category_menu()->detach();
                $songs= Song::where('category_id',$id)->get();
                foreach ($songs as $song){
                    $this->songservice->destroywithcate($song->id);
                }
                Category::where('id',$id)->delete();
            }
            Session::flash('success','Xóa thành công');
            return true;
        }catch (\Exception $err){
            Session::flash('error','Không thành công');
            return false;
        }
    }


    public function change_active($category){
        try {
            if ((int)$category->active == 1){
                $category->active = 0;
                $category->save();
                return true;
            }else{
                $category->active = 1;
                $category->save();
                return true;
            }
        }catch (\Exception $err){
            Session::flash('error','Thất bại');
            return false;
        }
    }




    public function getxxx(){

        return Song::distinct()->select('songs.name')
            ->join('categories','categories.id','=','songs.category_id',)
//            ->where('categories.name','like','%VN')
            ->orwhere('categories.name','like','Nhạc đồng quê')
            ->orwhere('categories.name','like','Cải lương')
            ->simplePaginate(12);
//            ->with('menutopic')->where('id',1)
    }

// Lay the loai theo nuoc dung de xep hang

    public function getVN(){
        return Category::where('name','like','%VN')
            ->orwhere('name','like','Nhạc đồng quê')
            ->orwhere('name','like','Cải lương')->where('active',1)->get();
    }


    public function getUSUK(){
        return Category::where('name','like','%USUK')->where('active',1)->get();
    }

    public function getKorea(){
        return Category::where('name','like','%Korea')->where('active',1)->get();
    }

    public function getcate_active(){
        return Category::where('active',1)->get();
    }

}
