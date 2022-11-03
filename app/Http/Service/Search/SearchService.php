<?php

namespace App\Http\Service\Search;

use App\Models\Playlist;
use App\Models\Singer;
use App\Models\Song;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SearchService
{
    function vn_str_filter ($str){
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );

        foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        return $str;
    }

    const LIMIT = 15;

    function mb_ucfirst($string, $encoding)
    {
        $firstChar = mb_substr($string, 0, 1, $encoding);
        $then = mb_substr($string, 1, null, $encoding);
        return mb_strtoupper($firstChar, $encoding) . $then;
    }

    public function getssong($request){
        $search= $request->input('search');
        $Search=  mb_convert_case($request->input('search'), MB_CASE_TITLE, "UTF-8");
        $search_notutf8 = $this->vn_str_filter($search);
        $first_up= $this->mb_ucfirst($search,'utf-8');
        if (strlen($search_notutf8)==strlen($search)){
            return  Song::Where('name','like','%'.  $search  .'%')
                ->where('active',1)->simplePaginate(self::LIMIT);
        }else{
            return Song::where('name','like Binary','%'. $search .'%')
                ->where('active',1)
                ->orWhere('name','like Binary','%'.  $Search  .'%')->where('active',1)
                ->orWhere('name','like Binary','%'.  $first_up .'%')->where('active',1)
                ->simplePaginate(self::LIMIT);
        }

    }


    public function getplaylist($request){
        $search= $request->input('search');
        $Search=  mb_convert_case($request->input('search'), MB_CASE_TITLE, "UTF-8");
        $search_notutf8 = $this->vn_str_filter($search);
        $first_up= $this->mb_ucfirst($search,'utf-8');
        if (strlen($search_notutf8)==strlen($search)){
            return  Playlist::Where('name','like','%'.  $search  .'%')
                ->where('active',1)->simplePaginate(self::LIMIT);
        }else{
            return Playlist::where('name','like Binary','%'. $search .'%')
                ->where('active',1)
                ->orWhere('name','like Binary','%'.  $Search  .'%')->where('active',1)
                ->orWhere('name','like Binary','%'.  $first_up  .'%')->where('active',1)
                ->simplePaginate(self::LIMIT);
        }
    }


    public function getsinger($request){
        $search= $request->input('search');
        $Search=  mb_convert_case($request->input('search'), MB_CASE_TITLE, "UTF-8");
        $search_notutf8 = $this->vn_str_filter($search);
        $first_up= $this->mb_ucfirst($search,'utf-8');
        if (strlen($search_notutf8)==strlen($search)){
            return  Singer::Where('name','like','%'.  $search  .'%')
                ->where('active',1)->simplePaginate(self::LIMIT);
        }else{
            return Singer::where('name','like Binary','%'. $search .'%')
                ->where('active',1)
                ->orWhere('name','like Binary','%'.  $Search  .'%')->where('active',1)
                ->orWhere('name','like Binary','%'.  $first_up  .'%')->where('active',1)
                ->simplePaginate(self::LIMIT);
        }
    }

    public function loadplaylist($page,$key){
        $search= $key;
        $Search=  mb_convert_case($key, MB_CASE_TITLE, "UTF-8");
        $search_notutf8 = $this->vn_str_filter($search);
        $first_up= $this->mb_ucfirst($search,'utf-8');
        if (strlen($search_notutf8)==strlen($search)){
            return  Playlist::Where('name','like','%'.  $search  .'%')
                ->where('active',1)->when($page!=null ,function ($query)use ($page){
                    $query->offset($page*self::LIMIT);
                })->limit(self::LIMIT)->get();
        }else{
            return Playlist::where('name','like Binary','%'. $search .'%')->where('active',1)
                ->orWhere('name','like Binary','%'.  $Search  .'%')->where('active',1)
                ->orWhere('name','like Binary','%'.  $first_up  .'%')->where('active',1)
                ->when($page!=null ,function ($query)use ($page){
                    $query->offset($page*self::LIMIT);
                })->limit(self::LIMIT)->get();
        }
    }

    public function count_list($key){
        $search= $key;
        $Search=  mb_convert_case($key, MB_CASE_TITLE, "UTF-8");
        $search_notutf8 = $this->vn_str_filter($search);
        $first_up= $this->mb_ucfirst($search,'utf-8');
        if (strlen($search_notutf8)==strlen($search)){
            return  count(Playlist::Where('name','like','%'.  $search  .'%')->where('active',1)->get());
        }else{
            return count(Playlist::where('name','like Binary','%'. $search .'%')->where('active',1)
                ->orWhere('name','like Binary','%'.  $Search  .'%')->where('active',1)
                ->orWhere('name','like Binary','%'.  $first_up  .'%')
                ->where('active',1)->where('active',1)->get());
        }
    }

    public function count_song($key){
        $search= $key;
        $Search=  mb_convert_case($key, MB_CASE_TITLE, "UTF-8");
        $search_notutf8 = $this->vn_str_filter($search);
        $first_up= $this->mb_ucfirst($search,'utf-8');
        if (strlen($search_notutf8)==strlen($search)){
            return  count(Song::Where('name','like','%'.  $search  .'%')->where('active',1)->get());
        }else{
            return count(Song::where('name','like Binary','%'. $search .'%')->where('active',1)
                ->orWhere('name','like Binary','%'.  $Search  .'%')->where('active',1)
                ->orWhere('name','like Binary','%'.  $first_up  .'%')
                ->where('active',1)->where('active',1)->get());
        }
    }

    public function count_singer($key){
        $search= $key;
        $Search=  mb_convert_case($key, MB_CASE_TITLE, "UTF-8");
        $search_notutf8 = $this->vn_str_filter($search);
        $first_up= $this->mb_ucfirst($search,'utf-8');
        if (strlen($search_notutf8)==strlen($search)){
            return  count(Singer::Where('name','like','%'.  $search  .'%')->where('active',1)->get());
        }else{
            return count(Singer::where('name','like Binary','%'. $search .'%')->where('active',1)
                ->orWhere('name','like Binary','%'.  $Search  .'%')->where('active',1)
                ->orWhere('name','like Binary','%'.  $first_up  .'%')
                ->where('active',1)->where('active',1)->get());
        }
    }

    public function loadsong($page,$key){
        $search= $key;
        $Search=  mb_convert_case($key, MB_CASE_TITLE, "UTF-8");
        $search_notutf8 = $this->vn_str_filter($search);
        $first_up= $this->mb_ucfirst($search,'utf-8');
        if (strlen($search_notutf8)==strlen($search)){
            return  Song::Where('name','like','%'.  $search  .'%')
                ->where('active',1)->when($page!=null ,function ($query)use ($page){
                    $query->offset($page*self::LIMIT);
                })->limit(self::LIMIT)->get();
        }else{
            return Song::where('name','like Binary','%'. $search .'%')->where('active',1)
                ->orWhere('name','like Binary','%'.  $Search  .'%')->where('active',1)
                ->orWhere('name','like Binary','%'.  $first_up .'%')
                ->where('active',1)
                ->when($page!=null ,function ($query)use ($page){
                    $query->offset($page*self::LIMIT);
                })->limit(self::LIMIT)->get();
        }
    }


    public function loadsinger($page,$key){
        $search= $key;
        $Search=  mb_convert_case($key, MB_CASE_TITLE, "UTF-8");
        $search_notutf8 = $this->vn_str_filter($search);
        $first_up= $this->mb_ucfirst($search,'utf-8');

        if (strlen($search_notutf8)==strlen($search)){
            return  Singer::Where('name','like','%'.  $search  .'%')
                ->where('active',1)->when($page!=null ,function ($query)use ($page){
                    $query->offset($page*self::LIMIT);
                })->limit(self::LIMIT)->get();
        }else{
            return Singer::where('name','like Binary','%'. $search .'%')->where('active',1)
                ->orWhere('name','like Binary','%'.  $Search  .'%')->where('active',1)
                ->orWhere('name','like Binary','%'.  $first_up  .'%')
                ->where('active',1)
                ->when($page!=null ,function ($query)use ($page){
                    $query->offset($page*self::LIMIT);
                })->limit(self::LIMIT)->get();
        }
    }


}
