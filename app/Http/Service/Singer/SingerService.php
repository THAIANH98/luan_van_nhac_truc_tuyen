<?php

namespace App\Http\Service\Singer;

use App\Models\Menu;
use App\Models\Playlist;
use App\Models\Singer;
use App\Models\Song;
use Illuminate\Support\Facades\Session;

class SingerService
{
    public function create($request){
        try {
            if((string) $request->input('avatar')!=null){
                $img=(string) $request->input('avatar');
            }else
                $img='/storage/upload/avatar/singer.png';

            Singer::create([
                'name'=>(string) $request->input('name'),
                'description'=>(string) $request->input('description'),
                'birthday'=>(string) $request->input('birthday'),
                'active'=>(int) $request->input('active'),
                'avatar'=>$img,
            ]);
            Session::flash('success','Thêm Thành Công');
        }catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }

    public function getlistsinger(){
        return Singer::simplePaginate(12);
    }

    public function update($request,$singer){
        try {
            $singer->fill($request->input());
            $singer->save();
            Session::flash('success','Cập Nhật Thành Công');
        }catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }

    public function destroy($request){
        try {
            $id = $request->input('id');
            $singer = Singer::where('id', $id)->first();
            if ($singer) {
                $singersong = Singer::find($id);
                $singersong->song_singer()->detach();
                Singer::where('id', $id)->delete();
            }
            Session::flash('success','Xóa thành công');
        }catch (\Exception $err){
            Session::flash('error','Không thành công');
            return false;
        }
        return true;
    }


    public function change_active($singer){
        try {
            if ((int)$singer->active == 1){
                $singer->active = 0;
                $singer->save();
                return true;
            }else{
                $singer->active = 1;
                $singer->save();
                return true;
            }
        }catch (\Exception $err){
            Session::flash('error','Thất bại');
            return false;
        }
    }

    public function getsinger(){
        return Singer::where('active',1)->get();
    }

    public function getrandom(){
        return Singer::select('avatar','id','name')->where('active',1)->inRandomOrder()->simplePaginate(9);
    }

    public function getsingerid($id){
        return Singer::where('id',$id)->firstOrFail();
    }


//    Lấy bài hát theo các ca sĩ của 1 bài hát
    public function getsingersong($id){
        $singers = Singer::distinct()->select('singers.id as id')
            ->join('songs_singers','songs_singers.singer_id','=','singers.id')
            ->join('songs','songs_singers.song_id','=','songs.id')
            ->where('songs.id',$id)->get();

        $arrsinger=[];

        foreach ($singers as $singer)
            $arrsinger[]=$singer->id;

        return Song::distinct()->select('songs.name as name','songs.id as id','songs.view as view')
            ->join('songs_singers','songs_singers.song_id','=','songs.id')
            ->join('singers','songs_singers.singer_id','=','singers.id')
            ->whereIn('singers.id',$arrsinger)
            ->where('songs.id','!=',$id)
            ->inRandomOrder()
            ->simplePaginate(10);
    }


    public function getlistsinger_of_playlist($idplaylist){
        $idsongs = Song::distinct()->select('songs.name as name','songs.id as id','songs.view as view')
            ->join('song_playlist','song_playlist.song_id','=','songs.id')
            ->join('playlists','song_playlist.playlist_id','=','playlists.id')
            ->where('playlists.id',$idplaylist)
            ->get();

//        dd($idsongs);
        $songs=[];
        $had = [];
        foreach ($idsongs as $idsong) {
            $had[]=$idsong->id;
        }

        $break=0;
        foreach ($idsongs as $idsong){
            foreach ($this->getsingersong($idsong->id) as $song){
                foreach ($songs as $insong)
                    if ($song->id == $insong->id || in_array($song->id,$had)==true){
                        $break=1;
                    }
                if ($break==1){
                    $break=0;
                    continue;
                }
                $songs[]=$song;
            }
        }

        return $songs;

    }

}
