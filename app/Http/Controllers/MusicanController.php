<?php

namespace App\Http\Controllers;

use App\Http\Service\Menu\MenuService;
use App\Http\Service\Musican\MusicanService;
use App\Http\Service\Playlist\PlaylistClientService;
use App\Http\Service\Singer\SingerService;
use App\Http\Service\Slider\SliderService;
use App\Http\Service\Song\SongClientServie;
use App\Models\Musican;
use Illuminate\Http\Request;

class MusicanController extends Controller
{

    protected  $menuservice;
    protected $sliderservice;
    protected $songservice;
    protected $playlistclientservice;
    protected $musicanservice;

    public function __construct(SliderService $sliderService,MenuService $menuService,SongClientServie $songService,PlaylistClientService $playlistService,MusicanService $musicanService)
    {
        $this->sliderservice = $sliderService;
        $this->playlistclientservice=$playlistService;
        $this->songservice = $songService;
        $this->musicanservice = $musicanService;
        $this->menuservice= $menuService;
    }


    public function index(Musican $musican){
        return view('musican.musicanpage',[
           'title'=>'Nhạc sĩ '. $musican->name,
            'musican'=>$musican,
            'cate'=>'notcate',
            'musicans'=>$this->musicanservice->getrandom(),
            'songs'=>$this->songservice->get_song_musican($musican->id),
            'top1song'=> $this->songservice->gettopsong_of_musican($musican->id),
            'top1playlist'=> $this->playlistclientservice->top1_playlist_musican($musican->id),
            'playlists'=>$this->playlistclientservice->get_playlist_musican($musican->id),
        ]);
    }
}
