<?php

namespace App\Http\Controllers\Admin\Slider;

use App\Http\Controllers\Controller;
use App\Http\Service\Slider\SliderService;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    protected $sliderservice;

    public function __construct(SliderService $sliderService)
    {
        $this->sliderservice=$sliderService;
    }

    public function create(){
        return view('admin.slider.add',[
            'title'=>' Slider ',
            'sliders'=>$this->sliderservice->getslider(),
            'var'=>0
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name',
            'url'
        ]) ;

        $this->sliderservice->create($request);
        return redirect()->back();
    }

//    public function list(){
//        return view('admin.slider.list',[
//            'title'=>'Danh Sách Slider',
//           'sliders'=>$this->sliderservice->getslider()
//        ]);
//    }


    public function edit(Slider $slider){
        return view('admin.slider.add',[
            'title'=>'Chỉnh Sửa Slider: '.$slider->name,
            'slider'=>$slider,
            'sliders'=>$this->sliderservice->getslider(),
            'var'=>1
        ]);
    }

    public function update(Request $request,Slider $slider){
        $this->validate($request,[
            'name',
            'url'
        ]) ;

        $this->sliderservice->update($request,$slider);
        return redirect('admin/slider/add');
    }

    public function destroy(Request $request)
    {
        $result = $this->sliderservice->destroy($request);
        if ($result===false)
            return response()->json([
                'error'=> true
            ]);
        else
            return redirect()->back();
    }

    public function change_active(Slider $slider)
    {
        $result = $this->sliderservice->change_active($slider);
        if ($result===false)
            return response()->json([
                'error'=> true,
                'active'=>$slider->active
            ]);
        else
            return response()->json([
                'error'=> false,
                'active'=>$slider->active,
                'id'=>$slider->id
            ]);
    }

}
