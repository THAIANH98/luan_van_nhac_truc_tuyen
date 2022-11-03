<?php

namespace App\Http\Controllers\Admin\Playlist;

use App\Http\Controllers\Controller;
use App\Http\Service\Category\CategoryService;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\Playlist\PlaylistService;
use App\Http\Service\Song\SongService;
use App\Models\Playlist;
use App\Models\Menu;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    protected $menuservice;
    protected $songservice;
    protected $playlistservice;
    protected $categoryservice;

    public function __construct(SongService $songService,PlaylistService $playlistService,CategoryService $categoryService,MenuService $menuService)
    {
        $this->songservice=$songService;
        $this->menuservice=$menuService;
        $this->categoryservice=$categoryService;
        $this->playlistservice=$playlistService;
    }

    public function create(){
        return view('admin.playlist.add',[
            'title'=>'Thêm Playlist Mới',
            'menus'=>$this->menuservice->getlistactive(),
            'songs'=>$this->songservice->getsongactive(),
            'category' => $this->categoryservice->getlist(),
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'
        ]);

        $this->playlistservice->create($request);
        return redirect()->back();
    }

    public function list(){
        return view('admin.playlist.list',[
            'title'=>'Danh Sách Playlist',
            'playlistxs'=>$this->playlistservice->getlist(),
            'menus'=>$this->menuservice->getlistactive(),
        ]);
    }

    public function edit(Playlist $playlist){
        return view('admin.playlist.edit',[
            'title'=>'Chỉnh Sửa Playlist: '.$playlist->name,
            'playlist'=>$playlist,
            'menus'=>$this->menuservice->getlistactive(),
            'songs'=>$this->songservice->getsongactive(),
            'category' => $this->categoryservice->getlist(),
        ]);
    }

    public function playlistmenu(Menu $menu){
        $idmenu=$menu->id;
        $playlist= $this->playlistservice->getplaylistmenu($idmenu);
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

    public function listsong(Playlist $playlist){
        $idplaylist = $playlist->id;
        $songs= $this->playlistservice->getsongplaylist($idplaylist);
        if (count($songs)==null)
            return response()->json([
                'error'=> true,
            ]);
        else
            return response()->json([
                'error'=> false,
                'song'=>$songs,
            ]);
    }

    public function playlistfull(){
        $playlist=$this->playlistservice->getlist();
//        $menu=$this->menuservice->getlistactive();
        if (count($playlist)==null)
            return response()->json([
                'error'=> true,
            ]);
        else
            return response()->json([
                'error'=> false,
                'playlist'=>$playlist,
//                'menu'=>$menu
            ]);
    }

    public function update(Playlist $playlist,Request $request){
        $this->validate($request,[
            'name'
        ]);
        $this->playlistservice->update($playlist,$request);
        return redirect('admin/playlist/list');
    }

    public function destroy(Request $request){
        $result = $this->playlistservice->destroy($request);
        if ($result===false)
            return response()->json([
                'error'=> true
            ]);
        else
            return response()->json([
                'error'=> false
            ]);
    }

    public function change_active(Playlist $playlist)
    {
        $result = $this->playlistservice->change_active($playlist);
        if ($result===false)
            return response()->json([
                'error'=> true,
                'active'=>$playlist->active
            ]);
        else
            return response()->json([
                'error'=> false,
                'active'=>$playlist->active,
                'id'=>$playlist->id
            ]);
    }
}
