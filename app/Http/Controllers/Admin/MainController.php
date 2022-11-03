<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Service\Category\CategoryService;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\Musican\MusicanService;
use App\Http\Service\Playlist\PlaylistService;
use App\Http\Service\Singer\SingerService;
use App\Http\Service\Song\SongService;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class MainController extends Controller
{
    protected $singerservice;
    protected $musicanservice;
    protected $songservice;
    protected $categoryservice;
    protected $playlistservice;
    protected $menuservice;

    public function __construct(MenuService  $menuService,PlaylistService $playlistService,MusicanService $musicanService,SingerService $singerService,SongService $songService,CategoryService $categoryService)
    {
        $this->musicanservice=$musicanService;
        $this->categoryservice =$categoryService;
        $this->singerservice=$singerService;
        $this->songservice=$songService;
        $this->menuservice = $menuService;
        $this->playlistservice=$playlistService;
    }


    public function index(){
        return view('admin.home',[
            'title'=>'Trang Chủ',
            'username'=>'ADMIN',
            'top10song'=>$this->songservice->gettop10(),
            'top10playlist'=>$this->playlistservice->gettop10(),
        ]);
    }

    public function browse_song(){
        $songs = $this->songservice->getsong_browse();
        return view('admin.browse.browse_song',[
            'title'=>'Duyệt Bài Hát',
            'songs'=>$songs,
            'menus'=>$this->menuservice->getlistactive(),
            'category' => $this->categoryservice->getlistactive(),
        ]);
    }

    public function browse_playlist(){
        return view('admin.browse.browse_playlist',[
            'title'=>'Duyệt Playlist',
            'playlistxs'=>$this->playlistservice->getlist_browse(),
            'menus'=>$this->menuservice->getlistactive(),
        ]);
    }

    public function list_genre(Category $category){
        $idcate=$category->id;
        $songs= $this->songservice->getsong_gen_browse($idcate);
        if (count($songs)==null)
            return response()->json([
                'error'=> true,
            ]);
        else
            return response()->json([
                'error'=> false,
                'songs'=>$songs,
                'catename'=>$category->name
            ]);
    }

    public function list_genre_menu(Menu $menu,Category $category){
        $idcate=$category->id;
        $idmenu=$menu->id;
        $songs= $this->songservice->getsong_gen_menu_browse($idmenu,$idcate);
        if (count($songs)==null)
            return response()->json([
                'error'=> true,
            ]);
        else
            return response()->json([
                'error'=> false,
                'songs'=>$songs,
                'catename'=>$category->name
            ]);
    }

    public function list_menu(Menu $menu){
        $idmenu=$menu->id;
        $category= $this->categoryservice->getcate_active();
        $songs= $this->songservice->getsong_menu_browse($idmenu);
        if (count($songs)==null)
            return response()->json([
                'error'=> true,
            ]);
        else
            return response()->json([
                'error'=> false,
                'songs'=>$songs,
                'cate'=>$category,
            ]);
    }


    public function list_genre_full(){
        $songs = $this->songservice->getsongfull_browse();
        if (count($songs)==null)
            return response()->json([
                'error'=> true,
            ]);
        else
            return response()->json([
                'error'=> false,
                'songs'=>$songs,
            ]);
    }

    public function destroy_song(Request $request){
        $result = $this->songservice->destroy_duyet($request);
        if ($result===false)
            return response()->json([
                'error'=> true
            ]);
        else
            return redirect()->back();
    }

    public function destroy_playlist(Request $request){
        $result = $this->playlistservice->destroy_duyet($request);
        if ($result===false)
            return response()->json([
                'error'=> true
            ]);
        else
            return redirect()->back();
    }

    public function playlistmenu(Menu $menu){
        $idmenu=$menu->id;
        $playlist= $this->playlistservice->getplaylistmenu_browse($idmenu);
        if (count($playlist)==null)
            return response()->json([
                'error'=> true,
            ]);
        else
            return response()->json([
                'error'=> false,
                'playlist'=>$playlist,
                'menu'=>$menu
            ]);
    }

}
