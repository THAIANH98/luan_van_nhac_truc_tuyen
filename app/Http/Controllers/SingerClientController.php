<?php

namespace App\Http\Controllers;

use App\Http\Service\Menu\MenuService;
use App\Http\Service\Playlist\PlaylistClientService;
use App\Http\Service\Singer\SingerService;
use App\Http\Service\Slider\SliderService;
use App\Http\Service\Song\SongClientServie;
use App\Models\Singer;
use Illuminate\Http\Request;

class SingerClientController extends Controller
{

    protected  $menuservice;
    protected $sliderservice;
    protected $songservice;
    protected $playlistclientservice;
    protected $singerservice;

    public function __construct(SliderService $sliderService,MenuService $menuService,SongClientServie $songService,PlaylistClientService $playlistService,SingerService $singerService)
    {
        $this->sliderservice = $sliderService;
        $this->playlistclientservice=$playlistService;
        $this->songservice = $songService;
        $this->singerservice = $singerService;
        $this->menuservice= $menuService;
    }


    public function index(Singer $singer){
        $singerid = $singer->id;
//        dd($this->songservice->gettopsong_of_singer($singerid));
        return view('singer.singerpage',[
            'title'=>'Ca Sĩ '.$singer->name,
            'singer'=>$singer,
            'cate'=>'notcate',
            'singers'=>$this->singerservice->getrandom(),
            'songs'=>$this->songservice->get_song_singer($singerid),
            'top1song'=> $this->songservice->gettopsong_of_singer($singerid),
            'top1playlist'=> $this->playlistclientservice->top1_playlist_singer($singerid),
            'playlists'=>$this->playlistclientservice->get_playlist_singer($singerid),
        ]);
    }

}
