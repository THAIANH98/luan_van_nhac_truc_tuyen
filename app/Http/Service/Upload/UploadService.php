<?php

namespace App\Http\Service\Upload;

class UploadService
{
    public function store($request){
        if($request->hasFile('avatar')){
            try {
                $name= $request->file('avatar')->getClientOriginalName();
                $pathFull ='upload/avatar';
                $path = $request->file('avatar')->storeAs(
                    '/public/'. $pathFull , $name
                );
                return '/storage/' . $pathFull . '/' . $name;
            }catch (\Exception $error){
                return false;
            }
        }
    }

    public function store_thumb($request){
        if($request->hasFile('thumb')){
            try {
                $name= $request->file('thumb')->getClientOriginalName();

                $pathFull ='uploads/thumb';
                $path = $request->file('thumb')->storeAs(
                    'public/'. $pathFull , $name
                );

                return '/storage/' . $pathFull . '/' . $name;
            }catch (\Exception $error){
                return false;
            }
        }
    }

    public function store_song($request){
        if($request->hasFile('file_song')){
            try {
                $name= $request->file('file_song')->getClientOriginalName();

                $pathFull ='uploads/song';
                $path = $request->file('file_song')->storeAs(
                    'public/'. $pathFull , $name
                );

                return '/storage/' . $pathFull . '/' . $name;
            }catch (\Exception $error){
                return false;
            }
        }
    }

}
