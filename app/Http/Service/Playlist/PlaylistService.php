<?php

namespace App\Http\Service\Playlist;

use App\Models\Playlist;
use App\Models\Topic;
use Illuminate\Support\Facades\Session;

class PlaylistService
{
    public function create($request){
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
                    'user_id'=>0,
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

    public function getlist(){
        return Playlist::get();
    }

    public function getlist_browse(){
        return Playlist::where('active',0)->get();
    }


    public function getplaylistmenu($idmenu){
        return Playlist::where('menu_id',$idmenu)->get();
    }

    public function getplaylistmenu_browse($idmenu){
        return Playlist::where('menu_id',$idmenu)->where('active',0)->get();
    }

    public function getsongplaylist($idplaylist){
        $pts = Playlist::find($idplaylist);
        return $pts->playlist_song()->get();
    }

    public function update($playlist,$request){
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

    public function destroy($request){
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

    public function destroy_duyet($request){
        try {
            $id = $request->input('id');

            $playlist= Playlist::where('id',$id)->first();

            if($playlist){
                $pts = Playlist::find($id);
                $pts->playlist_song()->detach();
                Playlist::where('id',$id)->delete();
                Session::flash('success','Từ chối thành công');
                return true;
            }
        }catch (\Exception $err){
            Session::flash('error','Từ chối thất bại');
            return false;
        }
    }

    public function change_active($playlist){
        try {
            if ((int)$playlist->active == 1){
                $playlist->active = 0;
                $playlist->save();
                return true;
            }else{
                $playlist->active = 1;
                $playlist->save();
                return true;
            }
        }catch (\Exception $err){
//            Session::flash('error','Thất bại');
            return false;
        }
    }

    public function getfulllist(){
        return Playlist::where('active',1)->get();
    }

    public function getlistid($id){
        return Playlist::where('id',$id)->firstOrFail();
    }

    public function getlisttopic($id){
        $topic= Topic::distinct()->select('topics.id as id')
            ->join('topic_playlist','topic_playlist.topic_id','=','topics.id')
            ->join('playlists','topic_playlist.playlist_id','=','playlists.id')
//            ->join('topic_playlist as tp','tp.playlist_id','=','playlist.id')
//            ->join('topics as t','tp.topic_id','=','t.id')
            ->where('playlists.id',$id)->inRandomOrder()->get();



        return Playlist::distinct()->select('playlists.name as name','playlists.id as id','playlists.thumb as thumb',)
            ->join('topic_playlist as tp','tp.playlist_id','=','playlists.id')
            ->join('topics as t','tp.topic_id','=','t.id')
            ->whereIn('t.id',$topic)
            ->where('playlists.id','!=',$id)
            ->where('playlists.active',1)
            ->simplePaginate(20);
    }

    public function getlistrandom($id){
        return Playlist::where('active',1)
            ->where('id','!=',$id)
            ->inRandomOrder()->simplePaginate(10);
    }

    public function plusview($id){
        $playlist= Playlist::where('id',$id)->first();

        if($playlist){
            $playlistview = Playlist::find($id);
            if($playlistview->view===NULL){
                $playlistview->view = 0;
            }
            $playlistview->view = $playlistview->view+1;
            $playlistview->save();
            return true;
        }
        return false;
    }

    public function gettop10(){
        return Playlist::where('active',1)->orderByDesc('view')->simplePaginate(10);
    }
//    Tìm kiếm
    public function search($request){
        $key =  (string) $request->input('search');
        return Playlist::where('active',1)
            ->where('name','like','%'.$key.'%',)
            ->get();
    }

}
