<?php

namespace App\Http\Service\Playlist;

use App\Http\Service\Song\SongClientServie;
use App\Models\Playlist;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Array_;
use phpDocumentor\Reflection\Utils;

class PlaylistClientService
{
    public function getnewplaylist(){
        return Playlist::where('active',1)->orderByDesc('created_at')->simplePaginate(10);
    }

    public function getplaylist_menu_client($idmenu){
        return Playlist::where('active',1)->where('menu_id',$idmenu)->orderByDesc('id')->simplePaginate(self::LIMIT);
    }

    const LIMIT = 20;

    public function load($page,$menu_id){
            return Playlist::where('active',1)->where('menu_id',$menu_id)->orderByDesc('id')->when($page!=null ,function ($query)use ($page){
                $query->offset($page*self::LIMIT);
            })->limit(self::LIMIT)->get();
    }

    public function loadplaylist_cate($page,$menu_id,$cate_id){
        return Playlist::where('active',1)->where('menu_id',$menu_id)->where('category_id',$cate_id)->orderByDesc('id')->when($page!=null ,function ($query)use ($page){
            $query->offset($page*self::LIMIT);
        })->limit(self::LIMIT)->get();
    }


    public function getplaylist_menu_cate_client($idmenu,$idcate){
        return Playlist::where('active',1)->where('menu_id',$idmenu)->where('category_id',$idcate)->orderByDesc('id')->simplePaginate(self::LIMIT);
    }

    public function countplaylist_menu_cate($idmenu,$idcate){
        return count(Playlist::where('active',1)->where('menu_id',$idmenu)->where('category_id',$idcate)->orderByDesc('id')->get());
    }


    public function countplaylist_menu($idmenu,$idcate=''){
        if ($idcate!='')
            return count(Playlist::where('active',1)->where('menu_id',$idmenu)->where('category_id',$idcate)->orderByDesc('id')->get());
        return count(Playlist::where('active',1)->where('menu_id',$idmenu)->orderByDesc('id')->get());
    }

    // LẤy ngẫu nhiên bài hát
    public function getsplaylistrandom($id){
        return Playlist::where('active',1)
            ->where('id','!=',$id)
            ->inRandomOrder()
            ->simplePaginate(30);
    }

    protected $songservice;

    public function __construct(SongClientServie $songClientServie)
    {
        $this->songservice = $songClientServie;
    }

    public function get_playlist_singer($idsinger){
        $songs = $this->songservice->get_song_singer($idsinger);

        $list_playlist = [];

        foreach ($songs as $key=>$song){
            $playlists=Playlist::distinct()->select('playlists.name as name','playlists.id as id','playlists.view as view','playlists.thumb as thumb')
                ->join('song_playlist','song_playlist.playlist_id','=','playlists.id')
                ->join('songs','song_playlist.song_id','=','songs.id')
                ->where('songs.id',$song->id)->get();

            foreach ($playlists as $playlist){
                $list_playlist[] = $playlist;
            }
        }
        return array_unique($list_playlist);
    }

    public function get_playlist_musican($id){
        $songs = $this->songservice->get_song_musican($id);

        $list_playlist = [];

        foreach ($songs as $key=>$song){
            $playlists=Playlist::distinct()->select('playlists.name as name','playlists.id as id','playlists.view as view','playlists.thumb as thumb')
                ->join('song_playlist','song_playlist.playlist_id','=','playlists.id')
                ->join('songs','song_playlist.song_id','=','songs.id')
                ->where('songs.id',$song->id)->get();

            foreach ($playlists as $playlist){
                $list_playlist[] = $playlist;
            }
        }
        return array_unique($list_playlist);
    }


// tăng view cho playlist
    public function plusview($id){
        $song= Playlist::where('id',$id)->first();

        if($song){
            $songview = Playlist::find($id);
            $songview->view = (int) $songview->view+1;
            $songview->save();
            return true;
        }
        return false;
    }

    public function top1_playlist_singer($id){
        $songs = $this->songservice->get_song_singer($id);

        $list_playlist = [];

        foreach ($songs as $key=>$song){
            $playlists=Playlist::distinct()->select('playlists.name as name','playlists.id as id','playlists.view as view','playlists.thumb as thumb')
                ->join('song_playlist','song_playlist.playlist_id','=','playlists.id')
                ->join('songs','song_playlist.song_id','=','songs.id')
                ->where('songs.id',$song->id)->get();

            foreach ($playlists as $playlist){
                $list_playlist[] = $playlist;
            }
        }
        $list_playlist= array_unique($list_playlist);
//        dd(count($list_playlist));
        if(count($list_playlist)!=0){
            $top1_playlist=$list_playlist[0];
            foreach ($list_playlist as $playlist){
                if($playlist->view > $top1_playlist->view)
                    $top1_playlist = $playlist;
            }
            return $top1_playlist;
        }
        return  false;
    }

    public function top1_playlist_musican($id){
        $songs = $this->songservice->get_song_musican($id);

        $list_playlist = [];

        foreach ($songs as $key=>$song){
            $playlists=Playlist::distinct()->select('playlists.name as name','playlists.id as id','playlists.view as view','playlists.thumb as thumb')
                ->join('song_playlist','song_playlist.playlist_id','=','playlists.id')
                ->join('songs','song_playlist.song_id','=','songs.id')
                ->where('songs.id',$song->id)->get();

            foreach ($playlists as $playlist){
                $list_playlist[] = $playlist;
            }
        }
        $list_playlist= array_unique($list_playlist);
//        dd(count($list_playlist));
        if(count($list_playlist)!=0){
            $top1_playlist=$list_playlist[0];
            foreach ($list_playlist as $playlist){
                if($playlist->view > $top1_playlist->view)
                    $top1_playlist = $playlist;
            }
            return $top1_playlist;
        }
        return  false;
    }

    public function get_playlist_goiy($menuid,$cateid){
        return Playlist::where('active',1)->where('menu_id',$menuid)->Orwhere('category_id',$cateid)->inRandomOrder()->simplePaginate(5);
    }

    public function create($request,$user){
        try {
            $songs = $request->input('song_id');
            if ($songs===null){
                Session::flash('error','Vui lòng chọn bài hát');
                return false;
            }else{
                if((string) $request->input('thumb')!=null){
                    $img=(string) $request->input('thumb');
                }else
                    $img='/storage/uploads/thumb/album.jpg';
                Playlist::create([
                    'name'=>(string) $request->input('name'),
                    'category_id'=>(integer) $request->input('category_id'),
                    'menu_id'=>(integer)$request->input('menu_id'),
                    'user_id'=>$user->id,
                    'active'=>(int) $request->input('active'),
                    'thumb'=>$img,
                ]);

                $playlist = Playlist::limit(1)->orderByDesc('id')->get();

                $pts = Playlist::find($playlist[0]->id);

                foreach ($songs as $songid){
                    $pts->playlist_song()->attach($songid);
                }
                Session::flash('success','Thêm thành công');
                return true;
            }
        }catch (\Exception $err){
            Session::flash('error', $err->getMessage());
            return false;
        }
    }

    public function get_playlist_user($user_id){
        return Playlist::where('user_id',$user_id)->simplePaginate(10);
    }

    public function delete_playlist($request){
        try {
            $id = $request->input('id');


            $playlist= Playlist::where('id',$id)->first();

            if($playlist){
                $pts = Playlist::find($id);
                $pts->playlist_song()->detach();
                Playlist::where('id',$id)->delete();
                Session::flash('success','Xóa thành công');
                return true;
            }
        }catch (\Exception $err){
            Session::flash('error','Xóa thất bại');
            return false;
        }
    }

    public function edit_playlist($playlist,$request){
        try {
            $songs = $request->input('song_id');
            if ($songs===null){
                Session::flash('error','Vui lòng chọn bài hát');
                return false;
            }else{
                $playlist->fill($request->input());
                $playlist->save();

                $pts = Playlist::find($playlist->id);
                $pts->playlist_song()->detach();

                foreach ($songs as $songid){
                    $pts->playlist_song()->attach($songid);
                }
                Session::flash('success','Cập nhật thành công');
                return true;
            }
        }catch (\Exception $err){
            Session::flash('error','Cập nhật thất bại');
            return false;
        }
    }


}
