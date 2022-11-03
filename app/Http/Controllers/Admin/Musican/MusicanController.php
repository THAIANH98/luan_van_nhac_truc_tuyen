<?php

namespace App\Http\Controllers\Admin\Musican;

use App\Http\Controllers\Controller;
use App\Http\Service\Musican\MusicanService;
use App\Models\Musican;
use Illuminate\Http\Request;

class MusicanController extends Controller
{
    protected $musicanservice;

    public function __construct(MusicanService $musicanService)
    {
        $this->musicanservice=$musicanService;
    }


    public function create(){
        return view('admin.musican.add',[
            'title'=>' Nhạc Sĩ ',
            'var'=>0,
            'musicans'=>$this->musicanservice->getlistmusican(),
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'avatar',
            'name'
        ]);

        $this->musicanservice->create($request);
        return redirect()->back();
    }


    public function edit(Musican $musican){
        return view('admin.musican.add',[
            'title'=>'Chỉnh Sửa Nhạc Sĩ',
            'musican'=>$musican,
            'var'=>1,
            'musicans'=>$this->musicanservice->getlistmusican()
        ]);
    }

    public function update(Request $request,Musican $musican){
        $this->validate($request,[
            'avatar',
            'name'
        ]);

        $this->musicanservice->update($request,$musican);
        return redirect('admin/musican/add');
    }

    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        $result = $this->musicanservice->destroy($request);
        if($result){
            return response()->json([
                'error'=> false,
            ]);
        }
        return response()->json([
            'error'=> true
        ]);
    }

    public function change_active(Musican $musican)
    {
        $result = $this->musicanservice->change_active($musican);
        if ($result===false)
            return response()->json([
                'error'=> true,
                'active'=>$musican->active
            ]);
        else
            return response()->json([
                'error'=> false,
                'active'=>$musican->active,
                'id'=>$musican->id
            ]);
    }
}
