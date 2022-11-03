<?php

namespace App\Http\Controllers;

use App\Http\Service\Menu\MenuService;
use App\Http\Service\Playlist\PlaylistClientService;
use App\Http\Service\Playlist\PlaylistService;
use App\Http\Service\Slider\SliderService;
use App\Http\Service\Song\SongClientServie;
use App\Http\Service\Song\SongService;
//use App\Http\Service\Topic\TopicService;
use \App\Http\Service\Search\SearchFileService;
use App\Models\Menu;
use App\Models\Slider;
use Illuminate\Http\Request;

class MainClientController extends Controller
{
    protected  $menuservice;
    protected $sliderservice;
    protected $songservice;
    protected $playlistservice;
    protected $test;


    public function __construct(SliderService $sliderService, MenuService $menuService, SongClientServie $songService, PlaylistClientService $playlistService, SearchFileService $testService)
    {
        $this->sliderservice = $sliderService;
        $this->playlistservice=$playlistService;
        $this->songservice = $songService;
        $this->menuservice= $menuService;
        $this->test =$testService;
    }

    public function index(){
        return view('home',[
            'title'=>'Nhạc Trực Tuyến',
            'sliders'=> $this->sliderservice->getslideractive(),
            'newsongs'=>$this->songservice->getnewsong(),
            'newplaylist'=>$this->playlistservice->getnewplaylist(),
        ]);
    }

    public function loadlistmenu(Request $request){
        $page = $request->input('page');
        $menu_id = $request->input('id');
        $result = $this->playlistservice->load($page,$menu_id);
        if (count($result)!=0){
            $html = view('menu.playlistpage',[
                'cate'=>'notcate',
                'playlists'=>$result,
                'menu'=>$menu_id,
                'countlist'=>$this->playlistservice->countplaylist_menu($menu_id),
            ])->render();
            return response()->json(['html'=>$html]);
        }
        return response()->json(['html'=>'']);
    }

    public function loadsongmenu(Request $request){
        $page = $request->input('page');
        $menu_id = $request->input('id');
        $result = $this->songservice->load($page,$menu_id);
        if (count($result)!=0){
            $html = view('menu.songpage',[
                'cate'=>'notcate',
                'songs'=>$result,
                'menu'=>$menu_id,
                'countsong'=>$this->songservice->countsong_menu($menu_id),
            ])->render();
            return response()->json(['html'=>$html]);
        }
        return response()->json(['html'=>'']);
    }


    public function loadplaylistcate(Request $request){
        $page = $request->input('page');
        $menu_id = $request->input('idmenu');
        $cate_id = $request->input('idcate');
        $result = $this->playlistservice->loadplaylist_cate($page,$menu_id,$cate_id);
        if (count($result)!=0){
            $html = view('menu.playlistpage',[
                'cate'=>$cate_id,
                'playlists'=>$result,
                'menu'=>$menu_id,
                'countlist'=>$this->playlistservice->countplaylist_menu($menu_id,$cate_id),
            ])->render();
            return response()->json(['html'=>$html]);
        }
        return response()->json(['html'=>'']);
    }

    public function loadsongcate(Request $request){
        $page = $request->input('page');
        $menu_id = $request->input('idmenu');
        $cate_id = $request->input('idcate');
        $result = $this->songservice->loadsong_cate($page,$menu_id,$cate_id);
        if (count($result)!=0){
            $html = view('menu.songpage',[
                'cate'=>$cate_id,
                'songs'=>$result,
                'menu'=>$menu_id,
                'countsong'=>$this->songservice->countsong_menu($menu_id,$cate_id),
            ])->render();
            return response()->json(['html'=>$html]);
        }
        return response()->json(['html'=>'']);
    }






}
