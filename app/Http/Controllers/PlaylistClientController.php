<?php

namespace App\Http\Controllers;

use App\Http\Service\Playlist\PlaylistClientService;
use App\Http\Service\Singer\SingerService;
use App\Http\Service\Song\SongClientServie;
use App\Models\Playlist;
use Illuminate\Http\Request;

class PlaylistClientController extends Controller
{

    protected $songservice;
    protected $singerservice;
    protected $playlistservice;

    public function __construct(SongClientServie $songService,SingerService $singerService,PlaylistClientService $playlistClientService)
    {
        $this->songservice = $songService;
        $this->singerservice = $singerService;
        $this->playlistservice=$playlistClientService;
    }

    public function playlistpage(Playlist $playlist){
        $id= $playlist->id;
        $menuid=$playlist->menu_id;
        $cateid= $playlist->category_id;
        $playlistrandom = $this->playlistservice->getsplaylistrandom($id);
        $singers= $this->singerservice->getlistsinger_of_playlist($id);
        return view('Play.playlistpage', [
            'title'=>$playlist->name,
            'playlistcurent'=>$playlist,
            'playlistrandom'=>$playlistrandom,
            'listgoiy'=>$this->playlistservice->get_playlist_goiy($menuid,$cateid),
            'songgoiy'=>$this->singerservice->getlistsinger_of_playlist($id),
        ]);
    }

    public function viewplus($id){
        $result= $this->playlistservice->plusview($id);
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
