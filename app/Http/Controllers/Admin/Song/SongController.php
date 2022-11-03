<?php

namespace App\Http\Controllers\Admin\Song;

use App\Http\Controllers\Controller;
use App\Http\Service\Category\CategoryService;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\Musican\MusicanService;
use App\Http\Service\Singer\SingerService;
use App\Http\Service\Song\SongService;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    protected $singerservice;
    protected $musicanservice;
    protected $songservice;
    protected $categoryservice;
    protected $menuservice;

    public function __construct(MenuService  $menuService,MusicanService $musicanService,SingerService $singerService,SongService $songService,CategoryService $categoryService)
    {
        $this->musicanservice=$musicanService;
        $this->categoryservice =$categoryService;
        $this->singerservice=$singerService;
        $this->songservice=$songService;
        $this->menuservice = $menuService;
    }

    public function create(){
        return view('admin.song.add',[
            'title'=>'Thêm Bài Hát Mới',
            'menus'=> $this->menuservice->getlistactive(),
            'singers'=>$this->singerservice->getsinger(),
            'category' => $this->categoryservice->getlist(),
            'musicans'=>$this->musicanservice->getmusican()
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name',
        ]);
        $this->songservice->create($request);
        return redirect()->back();
    }

    public function list(){
        $songs = $this->songservice->getsong();
        return view('admin.song.list',[
            'title'=>'Danh Sách Bài Hát',
            'songs'=>$songs,
            'menus'=>$this->menuservice->getlistactive(),
            'category' => $this->categoryservice->getlistactive(),
        ]);
    }

    public function edit(Song $song){
        return view('admin.song.edit',[
            'title'=>'Chỉnh Sửa Bài Hát: '.$song->name,
            'singers'=>$this->singerservice->getsinger(),
            'category' => $this->categoryservice->getlist(),
            'musicans'=>$this->musicanservice->getmusican(),
            'song'=>$song,
            'menus'=>$this->menuservice->getlist(),
        ]);
    }

    public function update(Song $song,Request $request){
        $this->validate($request,[
            'name',
        ]);
//        dd($request->input());
        if($this->songservice->update($request,$song))
            return redirect('admin/song/list');
        else
            return redirect()->back();
    }

    public function destroy(Request $request){
        $result = $this->songservice->destroy($request);
        if ($result===false)
            return response()->json([
                'error'=> true
            ]);
        else
            return redirect()->back();
    }

    public function change_active(Song $song)
    {
        $result = $this->songservice->change_active($song);
        if ($result===false)
            return response()->json([
                'error'=> true,
                'active'=>$song->active
            ]);
        else
            return response()->json([
                'error'=> false,
                'active'=>$song->active,
                'id'=>$song->id
            ]);
    }

    public function list_genre(Category $category){
        $idcate=$category->id;
        $songs= $this->songservice->getsong_gen($idcate);
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
        $songs= $this->songservice->getsong_gen_menu($idmenu,$idcate);
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
        $songs= $this->songservice->getsong_menu($idmenu);
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
        $songs = $this->songservice->getsongfull();
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

    public function viewplus($id){
        $result= $this->songservice->plusview($id);
        if ($result===false)
            return response()->json([
                'error'=> true,
            ]);
        else
            return response()->json([
                'error'=> false,
            ]);
    }

}
