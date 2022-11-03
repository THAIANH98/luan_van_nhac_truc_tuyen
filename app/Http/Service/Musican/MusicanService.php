<?php

namespace App\Http\Service\Musican;

use App\Models\Musican;
use Illuminate\Support\Facades\Session;

class MusicanService
{
    public function create($request){
        try {
            if((string) $request->input('avatar')!=null){
                $img=(string) $request->input('avatar');
            }else
                $img='/storage/upload/avatar/singer.png';

            Musican::create([
                'name'=>(string) $request->input('name'),
                'description'=>(string) $request->input('description'),
                'birthday'=>(string) $request->input('birthday'),
                'active'=>(int) $request->input('active'),
                'avatar'=>$img,
            ]);

            Session::flash('success','Thêm thành công');
        }catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }

    public function getrandom(){
        return Musican::select('avatar','id','name')->where('active',1)->inRandomOrder()->simplePaginate(9);
    }

    public function getlistmusican(){
        return Musican::simplePaginate(12);
    }

    public function update($request,$musican){
        try {
            $musican->fill($request->input());
            $musican->save();
            Session::flash('success','Cập nhật thành công');
        }catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }

    public function destroy($request){
        try {
            $id = $request->input('id');
            $musican= Musican::where('id',$id)->first();

            if($musican){
                Musican::where('id',$id)->delete();
            }
            Session::flash('success','Xóa thành công');
            return true;
        }catch (\Exception $err){
            Session::flash('error','Không thể xóa nhạc sĩ này');
            return false;
        }
    }

    public function change_active($musican){
        try {
            if ((int)$musican->active == 1){
                $musican->active = 0;
                $musican->save();
                return true;
            }else{
                $musican->active = 1;
                $musican->save();
                return true;
            }
        }catch (\Exception $err){
            Session::flash('error','Thất bại');
            return false;
        }
    }



    public function getmusican(){
        return Musican::where('active',1)->get();
    }

}
