<?php

namespace App\Http\Service\Song;

use App\Models\Musican;
use App\Models\Song;
use Illuminate\Support\Facades\Session;

class SongClientServie
{
    const LIMIT = 20;

    public function getsong_menu_client($idmenu){
        return Song::where('active',1)->where('menu_id',$idmenu)->orderByDesc('id')->simplePaginate(self::LIMIT);
    }

    public function countsong_menu($idmenu,$idcate=''){
        if ($idcate!='')
            return count(Song::where('active',1)->where('menu_id',$idmenu)->where('category_id',$idcate)->orderByDesc('id')->get());

        return count(Song::where('active',1)->where('menu_id',$idmenu)->orderByDesc('id')->get());
    }

    public function getsong_menu_cate_client($idmenu,$idcate){
        return Song::where('active',1)->where('menu_id',$idmenu)->where('category_id',$idcate)->orderByDesc('id')->simplePaginate(self::LIMIT);
    }

    public function countsong_menu_cate($idmenu,$idcate){
        return count(Song::where('active',1)->where('menu_id',$idmenu)->where('category_id',$idcate)->orderByDesc('id')->get());
    }

    public function load($page,$menu_id){
        return Song::where('active',1)->where('menu_id',$menu_id)->orderByDesc('id')->when($page!=null ,function ($query)use ($page){
            $query->offset($page*self::LIMIT);
        })->limit(self::LIMIT)->get();
    }

    public function loadsong_cate($page,$menu_id,$cate_id){
        return Song::where('active',1)->where('menu_id',$menu_id)->where('category_id',$cate_id)->orderByDesc('id')->when($page!=null ,function ($query)use ($page){
            $query->offset($page*self::LIMIT);
        })->limit(self::LIMIT)->get();
    }


    public function getnewsong(){
        return Song::where('active',1)->orderByDesc('id')->simplePaginate(10);
    }

    //    Lấy bài hát theo ID
    public function getsongid($id){
        return Song::where('id',$id)->firstOrFail();
    }


    //    Lấy bài hát theo ca sĩ
    public function get_song_singer($singerid){
        return Song::distinct()->select('songs.name as name','songs.id as id','songs.view as view','songs.thumb as thumb')
            ->join('songs_singers','songs_singers.song_id','=','songs.id')
            ->join('singers','songs_singers.singer_id','=','singers.id')
            ->where('singers.id',$singerid)->get();
    }


    //    Lấy bài hát theo nhạc sĩ
    public function get_song_musican($id){
        return Song::where('active',1)->where('musican_id',$id)->get();
    }


    public function gettopsong_of_musican($id){
        $song = Song::where('active',1)->where('musican_id',$id)->orderByDesc('view')->first();
        if ($song===null){
            return false;
        }else{
            return $song;
        }
    }


// LẤy ngẫu nhiên bài hát
    public function getsongrandom($id){
        return Song::where('active',1)
            ->where('id','!=',$id)
            ->inRandomOrder()
            ->simplePaginate(30);
    }

    public function plusview($id){
        $song= Song::where('id',$id)->first();

        if($song){
            $songview = Song::find($id);
            $songview->view = (int) $songview->view+1;
            $songview->save();
            return true;
        }
        return false;
    }

    public function gettopsong_of_singer($id){
        $song = Song::distinct()->select('songs.name as name','songs.id as id','songs.view as view','songs.thumb as thumb')
            ->join('songs_singers','songs_singers.song_id','=','songs.id')
            ->join('singers','songs_singers.singer_id','=','singers.id')
            ->where('singers.id',$id)->orderByDesc('view')->first();
        if ($song===null){
            return false;
        }else{
            return $song;
        }
    }

    public function getsong_menu_playsong($idmenu){
        return Song::where('active',1)->where('menu_id',$idmenu)
            ->inRandomOrder()->simplePaginate(10);
    }

    public function getsong_file_song($file){
        return Song::where('active',1)
            ->where('file_song','LIKE','%'.$file.'%')->first();
    }




    public function create($request,$user){
        try {
            $musican = Musican::where('name',$request->input('musican_name'))->first();
            if($musican==null){
                Musican::create([
                    'name'=>(string) $request->input('musican_name'),
                    'active'=>1,
                    'avatar'=>'/storage/upload/avatar/singer.png',
                ]);
            }
            $musican = Musican::where('name',$request->input('musican_name'))->first();
            $singers = $request->input('singer_id');
            if ($singers==null){
                Session::flash('error','Vui lòng chọn ca sĩ');
                return false;
            }
            if((string) $request->input('thumb')!=null){
                $img=(string) $request->input('thumb');
            }else
                $img='/storage/uploads/thumb/music.jpg';

            Song::create([
                'name'=>(string) $request->input('name'),
                'musican_id'=>$musican->id,
                'category_id'=>(integer) $request->input('category_id'),
                'menu_id'=>(integer)$request->input('menu_id'),
                'user_id'=>$user->id,
                'file_song'=>(string) $request->input('file_song'),
                'lyric'=>(string) $request->input('lyric'),
                'active'=>0,
                'thumb'=>$img,
            ]);

            $songid = Song::limit(1)->orderByDesc('id')->get();

            $mss = Song::find($songid[0]->id);
            foreach ($singers as $singerid){
                $mss->song_singer()->attach($singerid);
            }
            Session::flash('success','Thêm thành công');
            return true;

        }catch (\Exception $err){
         if(strchr($err->getMessage(),'SQLSTATE[23000]:') !='') {
             Session::flash('error','Bài hát đã tồn tại');
         }
            return false;
        }
    }


    public function get_song_user($user_id){
        return Song::where('user_id',$user_id)->simplePaginate(10);
    }


    public function delete_song($request){
        try{
            $id = $request->input('id');
            $mss = Song::find($id);
            $mss->song_singer()->detach();
            $mss->song_playlist()->detach();

            $song= Song::where('id',$id)->first();

            if($song){
                Song::where('id',$id)->delete();
                Session::flash('success','Xóa thành công');
            }
        }catch (\Exception $err){
            Session::flash('error','Không xóa được bài hát này');
            return false;
        }
        return true;
    }

    public function edit_song($song,$request){
        try {
            $musican = Musican::where('name',$request->input('musican_name'))->first();
            if($musican==null){
                Musican::create([
                    'name'=>(string) $request->input('musican_name'),
                    'active'=>1,
                    'avatar'=>'/storage/upload/avatar/singer.png',
                ]);
            }
            $musican = Musican::where('name',$request->input('musican_name'))->first();
            $singers = $request->input('singer_id');
            if ($singers===null){
                Session::flash('error','Vui lòng chọn ca sĩ');
                return false;
            }else{
                if((string) $request->input('thumb')!=null){
                    $img=(string) $request->input('thumb');
                }else
                    $img='/storage/uploads/thumb/music.png';
                $song->name=(string)$request->input('name');
                $song->musican_id =  $musican->id;
                $song->category_id=(integer)$request->input('category_id');
                $song->menu_id=(integer)$request->input('menu_id');
                $song->file_song=(string)$request->input('file_song');
                $song->lyric=(string)$request->input('lyric');
                $song->thumb = '/storage/uploads/thumb/music.jpg';
                $song->save();

                $mss = Song::find($song->id);
                $mss->song_singer()->detach();

                foreach ($singers as $singerid){
                    $mss->song_singer()->attach($singerid);
                }

                Session::flash('success','Cập nhật thành công');
                return true;
            }

        }catch (\Exception $err){
            Session::flash('error', $err->getMessage());
            return false;
        }
    }

}
