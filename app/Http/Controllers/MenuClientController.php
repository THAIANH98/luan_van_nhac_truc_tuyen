<?php

namespace App\Http\Controllers;

use App\Http\Service\Menu\MenuService;
use App\Http\Service\Playlist\PlaylistClientService;
use App\Http\Service\Playlist\PlaylistService;
use App\Http\Service\Slider\SliderService;
use App\Http\Service\Song\SongClientServie;
use App\Http\Service\Song\SongService;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuClientController extends Controller
{
    protected  $menuservice;
    protected $sliderservice;
    protected $songservice;
    protected $playlistclientservice;


    public function __construct(SliderService $sliderService,MenuService $menuService,SongClientServie $songService,PlaylistClientService $playlistService)
    {
        $this->sliderservice = $sliderService;
        $this->playlistclientservice=$playlistService;
        $this->songservice = $songService;
        $this->menuservice= $menuService;
    }

    public function index(Menu $menu){
        $idmenu= $menu->id;

        return view('menupage',[
            'title'=>$menu->name,
            'menu'=>$menu->id,
            'cate'=>'notcate',
            'sliders'=> $this->sliderservice->getslideractive(),
            'songs'=>$this->songservice->getsong_menu_client($idmenu),
            'countsong'=>$this->songservice->countsong_menu($idmenu),
            'countlist'=>$this->playlistclientservice->countplaylist_menu($idmenu),
            'playlists'=>$this->playlistclientservice->getplaylist_menu_client($idmenu),
        ]);
    }

    public function store(Menu $menu,Category $cate){
        $idmenu= $menu->id;
        $idcate= $cate->id;

        return view('catepage',[
            'title'=>$menu->name .' > '.$cate->name ,
            'menu'=>$menu->id,
            'cate'=>$idcate,
            'songs'=>$this->songservice->getsong_menu_cate_client($idmenu,$idcate),
            'countsong'=>$this->songservice->countsong_menu_cate($idmenu,$idcate),
            'countlist'=>$this->playlistclientservice->countplaylist_menu_cate($idmenu,$idcate),
            'playlists'=>$this->playlistclientservice->getplaylist_menu_cate_client($idmenu,$idcate),
        ]);
    }
}
