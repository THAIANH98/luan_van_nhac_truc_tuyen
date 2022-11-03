<?php

namespace App\Http\Controllers\Admin\Upload;

use App\Http\Controllers\Controller;
use App\Http\Service\Upload\UploadService;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    protected $upload;

    public function __construct(UploadService $uploadSevice)
    {
        $this->upload = $uploadSevice;
    }

    public function store(Request $request){
//        dd($request->input());
        $url = $this->upload->store($request);
        if($url!=false){
            return response()->json([
                'error'=>false,
                'url'=>$url,
            ]);
        }
        return response()->json(['error'=>true]);
    }

    public function store_thumb(Request $request){
//        dd($request->file());
        $url = $this->upload->store_thumb($request);
        if($url!=false){
            return response()->json([
                'error'=>false,
                'url'=>$url,
            ]);
        }
        return response()->json(['error'=>true]);
    }

    public function store_song(Request $request){
//        dd($request->file());
        $url = $this->upload->store_song($request);
        if($url!=false){
            return response()->json([
                'error'=>false,
                'url'=>$url,
            ]);
        }
        return response()->json(['error'=>true]);
    }

}
