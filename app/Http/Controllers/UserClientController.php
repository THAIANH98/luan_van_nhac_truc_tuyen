<?php

namespace App\Http\Controllers;

use App\Http\Service\Category\CategoryService;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\Musican\MusicanService;
use App\Http\Service\Playlist\PlaylistClientService;
use App\Http\Service\Singer\SingerService;
use App\Http\Service\Song\SongClientServie;
use App\Http\Service\Song\SongService;
use App\Http\Service\User\UserService;
use App\Models\Playlist;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;

class UserClientController extends Controller
{
    protected $singerservice;
    protected $musicanservice;
    protected $songservice;
    protected $categoryservice;
    protected $menuservice;
    protected $playlistservice;
    protected $userservice;
    public function __construct(UserService $userService,MenuService  $menuService,MusicanService $musicanService,SingerService $singerService,SongClientServie $songService,
                                CategoryService $categoryService,PlaylistClientService $playlistClientService)
    {
        $this->userservice = $userService;
        $this->musicanservice=$musicanService;
        $this->categoryservice =$categoryService;
        $this->singerservice=$singerService;
        $this->songservice=$songService;
        $this->menuservice = $menuService;
        $this->playlistservice = $playlistClientService;
    }

    public function song_user(User $user){
        return view('user.song.thembaihat',[
           'title'=>'Thêm bài hát ',
            'user'=>$user,
            'menus'=> $this->menuservice->getlistactive(),
            'singers'=>$this->singerservice->getsinger(),
            'category' => $this->categoryservice->getlistactive(),
            'musicans'=>$this->musicanservice->getmusican()
        ]);
    }

    public function create_song_user(Request $request,User $user){
        $this->songservice->create($request,$user);
        return redirect()->back();
    }

    public function playlist_user(User $user){
        return view('user.playlist.themplaylist',[
            'title'=>'Thêm Playlist',
            'user'=>$user,
            'menus'=> $this->menuservice->getlistactive(),
            'singers'=>$this->singerservice->getsinger(),
            'category' => $this->categoryservice->getlistactive(),
            'musicans'=>$this->musicanservice->getmusican(),
        ]);
    }


    public function create_playlist_user(Request $request,User $user){
        $this->playlistservice->create($request,$user);
        return redirect()->back();
    }


    public function info_user(User $user){
        return view('user.info_user',[
            'title'=>'Quản lý tài khoản',
            'user'=>$user,

        ]);
    }

    public function edit_username(User $user,Request $request){
        $usernew = $this->userservice->edit_username($user->id,$request);
        return response()->json([
            'error'=>false,
            'name'=>$usernew->username,
        ]);
    }

    public function edit_name(User $user,Request $request){
        $usernew = $this->userservice->edit_name($user->id,$request);
        return response()->json([
            'error'=>false,
            'name'=>$usernew->name,
        ]);
    }

    public function edit_avatar(User $user,Request $request){
        $usernew = $this->userservice->edit_avatar($user->id,$request);
        return response()->json([
            'error'=>false,
        ]);
    }

    public function list_song_user(User $user){
        $singerid = $user->id;
        $songs= $this->songservice->get_song_user($singerid);
        return view('user.song.list_song',[
            'title'=>'Danh sách bài hát của bạn',
            'user'=>$user,
            'songs'=>$songs,
        ]);
    }

    public function edit_song(Song $song,User $user){
        return view('user.song.edit_song',[
           'title'=>'Sửa bài hát: '.$song->name,
            'user'=>$user,
            'song'=>$song,
            'menus'=> $this->menuservice->getlistactive(),
            'singers'=>$this->singerservice->getsinger(),
            'category' => $this->categoryservice->getlistactive(),
            'musicans'=>$this->musicanservice->getmusican(),
        ]);
    }

    public function store_edit_song(Song $song,Request $request,User $user){
         $this->songservice->edit_song($song,$request);
        return redirect('user/list_song/'.$user->id);
    }

    public function delete_song_user(Request $request){
        $this->songservice->delete_song($request);
    }


    public function list_playlist_user(User $user){
        $playlists = $this->playlistservice->get_playlist_user($user->id);
        return view('user.playlist.list_playlist',[
                'title'=>'Danh sách Playlist',
                'user'=>$user,
                'playlists'=>$playlists,
        ]);
    }

    public function delete_playlist_user(Request $request){
        $this->playlistservice->delete_playlist($request);
    }

    public function edit_playlist(Playlist $playlist,User $user){
        return view('user.playlist.edit_playlist',[
            'title'=>'Sửa playlist',
            'playlist'=>$playlist,
            'user'=>$user,
            'menus'=> $this->menuservice->getlistactive(),
            'singers'=>$this->singerservice->getsinger(),
            'category' => $this->categoryservice->getlistactive(),
            'musicans'=>$this->musicanservice->getmusican(),
        ]);
    }

    public function store_edit_playlist(Playlist $playlist, Request $request,User $user){
        $this->playlistservice->edit_playlist($playlist,$request);
        return redirect('user/list_playlist/'.$user->id);
    }

}
