<?php

namespace App\Http\Controllers;

use App\Http\Service\Playlist\PlaylistClientService;
use App\Http\Service\Singer\SingerService;
use App\Http\Service\Song\SongClientServie;
use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Type;

class SongClientController extends Controller
{
    protected $songservice;
    protected $singerservice;
    protected $playlistservice;

    public function __construct(SongClientServie $songService,SingerService $singerService,PlaylistClientService $playlistClientService)
    {
        $this->songservice = $songService;
        $this->singerservice = $singerService;
        $this->playlistservice = $playlistClientService;
    }

    public function songpage(Song $song,$slug=''){
        $menuid= $song->menu_id;
        $cateid= $song->category_id;
        $id=$song->id;
        $songrandom= $this->songservice->getsongrandom($id);
        $songofsinger = $this->singerservice->getsingersong($id);
        if (count($songofsinger)<=1){
            $songofsinger = $this->songservice->getsong_menu_playsong($song->menu_id);
        }

        return view('Play.playsongpage',[
            'title'=> 'Bài Hát-'. $song->name,
            'song'=>$song,
            'idsong'=>$song->id,
            'songsinger'=>$songofsinger,
            'songrandom'=>$songrandom,
            'listgoiy'=>$this->playlistservice->get_playlist_goiy($menuid,$cateid),
        ]);
    }

}
