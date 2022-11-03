<?php

namespace App\Http\Service\Song;

use App\Models\Category;
use App\Models\Musican;
use App\Models\Singer;
use App\Models\Song;
use App\Models\Topic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SongService
{

    public function create($request){
        try {
            $singers = $request->input('singer_id');
            $name_musican = $request->input('musican_name');
            if ($singers==null){
                Session::flash('error','Vui lòng chọn ca sĩ');
                return false;
            }
            if ($name_musican==null){
                Session::flash('error','Vui lòng chọn nhạc sĩ');
                return false;
            }else{
                if((string) $request->input('thumb')!=null){
                    $img=(string) $request->input('thumb');
                }else
                    $img='/storage/uploads/thumb/music.jpg';

                $id_musican= Musican::where('name',$name_musican)->first();

                Song::create([
                    'name'=>(string) $request->input('name'),
                    'category_id'=>(integer) $request->input('category_id'),
                    'menu_id'=>(integer)$request->input('menu_id'),
                    'user_id'=>0,
                    'musican_id'=>(integer)$id_musican->id,
                    'file_song'=>(string) $request->input('file_song'),
                    'lyric'=>(string) $request->input('lyric'),
                    'active'=>(int) $request->input('active'),
                    'thumb'=>$img,
                ]);

                $songid = Song::limit(1)->orderByDesc('id')->get();

                $mss = Song::find($songid[0]->id);
                foreach ($singers as $singerid){
                    $mss->song_singer()->attach($singerid);
                }
                Session::flash('success','Thêm thành công');
                return true;
            }

        }catch (\Exception $err){
//            'Thêm thất bại'
            Session::flash('error',$err->getMessage());
            return false;
        }
    }

    public function update($request,$song){
        try {
            $singers = $request->input('singer_id');
            $name_musican = $request->input('musican_name');
            $id_musican= Musican::where('name',$name_musican)->first();
            if ($singers===null){
                Session::flash('error','Vui lòng chọn ca sĩ');
                return false;
            }
            if ($name_musican===null){
                Session::flash('error','Vui lòng chọn nhạc sĩ');
                return false;
            }else{
                if((string) $request->input('thumb')!=null){
                    $img=(string) $request->input('thumb');
                }else
                    $img='/storage/uploads/thumb/music.png';
                $song->name=(string)$request->input('name');
                $song->category_id=(integer)$request->input('category_id');
                $song->menu_id=(integer)$request->input('menu_id');
                $song->file_song=(string)$request->input('file_song');
                $song->lyric=(string)$request->input('lyric');
                $song->active=(integer)$request->input('active');
                $song->musican_id=(integer)$id_musican->id;
                $song->thumb = $img;
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

    public function destroy($request){
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


    public function destroy_duyet($request){
        try{
            $id = $request->input('id');
            $mss = Song::find($id);
            $mss->song_singer()->detach();
            $mss->song_playlist()->detach();

            $song= Song::where('id',$id)->first();

            if($song){
                Song::where('id',$id)->delete();
                Session::flash('success','Từ chối thành công');
            }
        }catch (\Exception $err){
//            Session::flash('error','Không xóa được bài hát này');
            return false;
        }
        return true;
    }



    public function destroywithcate($id){
        try{
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

    public function change_active($song){
        try {
            if ((int)$song->active == 1){
                $song->active = 0;
                $song->save();
                return true;
            }else{
                $song->active = 1;
                $song->save();
                return true;
            }
        }catch (\Exception $err){
            Session::flash('error','Thất bại');
            return false;
        }
    }

    public function getsong_gen($idcate){
        return Song::where('active',1)->where('category_id',$idcate)->get();
    }

    public function getsong_gen_browse($idcate){
        return Song::where('active',0)->where('category_id',$idcate)->get();
    }


    public function getsong_gen_menu($idmenu,$idcate){
        return Song::where('active',1)->where('category_id',$idcate)->where('menu_id',$idmenu)->get();
    }

    public function getsong_gen_menu_browse($idmenu,$idcate){
        return Song::where('active',0)->where('category_id',$idcate)->where('menu_id',$idmenu)->get();
    }

    public function getsong_menu($idmenu){
        return Song::where('active',1)->where('menu_id',$idmenu)->get();
    }

    public function getsong_menu_browse($idmenu){
        return Song::where('active',0)->where('menu_id',$idmenu)->get();
    }

    public function getsong(){
        return Song::orderBy('id')->get();
    }

    public function getsong_browse(){
        return Song::orderBy('id')->where('active',0)->get();
    }

    public function getsongfull(){
        return Song::where('active',1)->get();
    }

    public function getsongfull_browse(){
        return Song::where('active',0)->get();
    }

    public function getsongactive(){
        return Song::where('active',1)->get();
    }

//    Xếp hạng Home
    public function getsongrating(){
        return Song::where('active',1)->orderByDesc('view')->simplePaginate(10);
    }

//    Top 100 bài hat
    public function gettop10(){
        return Song::where('active',1)->orderByDesc('view')->simplePaginate(10);
    }


    public function getsongid($id){
        return Song::where('id',$id)->firstOrFail();
    }//    Lấy bài hát theo ID

//    Lấy bài hát theo ca sĩ
    public function getsongsinger($id){
        return Song::distinct()->select('songs.name as name','songs.id as id','songs.view as view','songs.thumb as thumb')
            ->join('song_singer','song_singer.song_id','=','songs.id')
            ->join('singers','song_singer.singer_id','=','singers.id')
            ->where('singers.id',$id)->simplePaginate(10);
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


//    Tìm kiếm
    public function search($request){
        $key =  (string) $request->input('search');
        return Song::where('active',1)->where('name','like','%'.$key.'%',)->get();
    }

}
