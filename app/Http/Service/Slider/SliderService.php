<?php

namespace App\Http\Service\Slider;

use App\Models\Slider;
use Illuminate\Support\Facades\Session;

class SliderService
{

    public function create($request){
        try {
            Slider::create($request->input());
            Session::flash('success','Thêm thành công');
            return true;
        }catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
    }

    public function getslider(){
        return Slider::simplePaginate(12);
    }

    public function update($request,$slider){
        try {
            $slider->fill($request->input());
            $slider->save();
            Session::flash('success','Thêm thành công');
            return true;
        }catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
    }

    public function destroy($request){

        $id = $request->input('id');
        $slider= Slider::where('id',$id)->first();

        if($slider){
            Slider::where('id',$id)->delete();
            return true;
        }
        return false;
    }

    public function change_active($slider){
        try {
            if ((int)$slider->active == 1){
                $slider->active = 0;
                $slider->save();
                return true;
            }else{
                $slider->active = 1;
                $slider->save();
                return true;
            }
        }catch (\Exception $err){
            Session::flash('error','Thất bại');
            return false;
        }
    }

    public function getslideractive(){
        return Slider::where('active',1)->orderBy('id')->get();
    }

}
