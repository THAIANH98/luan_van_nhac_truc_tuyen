<?php

namespace App\Http\Controllers;

use \App\Http\Service\Search\SearchFileService;
use App\Http\Service\Upload\UploadClientService;
use Illuminate\Http\Request;

class UploadClientController extends Controller
{
    protected $test;
    protected $upload;


    public function __construct(UploadClientService $uploadSevice,SearchFileService  $testService)
    {
        $this->upload = $uploadSevice;
        $this->test=$testService;
    }

    public function store(Request $request){
        $this->upload->deleteall();
        $url = $this->upload->store($request);
        $shape = $this->test->create_feat();
        if($url!=false){
            return response()->json([
                'error'=>false,
                'url'=>$url,
                'shape'=>$shape,
            ]);
        }
        return response()->json(['error'=>true]);
    }

    public function song_user(Request $request){
        $url = $this->upload->store_song($request);
        if($url!=false){
            return response()->json([
                'error'=>false,
                'url'=>$url,
            ]);
        }
        return response()->json(['error'=>true]);
    }

    public function playlist_user(Request $request){
        $url = $this->upload->store_playlist($request);
        if($url!=false){
            return response()->json([
                'error'=>false,
                'url'=>$url,
            ]);
        }
        return response()->json(['error'=>true]);
    }

    public function avatar_user(Request $request){
//        dd($request->input());
        $url = $this->upload->store_avatar($request);
        if($url!=false){
            return response()->json([
                'error'=>false,
                'url'=>$url,
            ]);
        }
        return response()->json(['error'=>true]);
    }
}
