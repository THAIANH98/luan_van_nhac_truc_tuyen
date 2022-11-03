<?php

namespace App\Http\Controllers\Admin\Singer;

use App\Http\Controllers\Controller;
use App\Http\Service\Singer\SingerService;
use App\Models\Singer;
use Illuminate\Http\Request;

class SingerController extends Controller
{
    protected $singerservice;

    public function __construct(SingerService $singerService)
    {
        $this->singerservice=$singerService;
    }


    public function create(){
        return view('admin.singer.add',[
            'title'=>' Ca Sĩ ',
            'singers'=>$this->singerservice->getlistsinger(),
            'var'=>0
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'avatar',
            'name'
        ]);

        $this->singerservice->create($request);
        return redirect()->back();
    }

//    public function list(){
//        return view('admin.singer.list',[
//            'title'=>'Danh Sách Ca Sĩ',
//            'singers'=>$this->singerservice->getlistsinger()
//        ]);
//    }

    public function edit(Singer $singer){
        return view('admin.singer.add',[
            'title'=>'Chỉnh Sửa Ca Sĩ: '.$singer->name ,
            'singer_edit'=>$singer,
            'singers'=>$this->singerservice->getlistsinger(),
            'var'=>1
        ]);
    }

    public function update(Request $request,Singer $singer){
        $this->validate($request,[
            'avatar',
            'name'
        ]);

        $this->singerservice->update($request,$singer);
        return redirect('admin/singer/add');
    }

    public function destroy(Request $request)
    {
        $result = $this->singerservice->destroy($request);
//        dd($result);
        if($result){
            return response()->json([
                'error'=> false,
            ]);
        }else
            return response()->json([
                'error'=> true,
            ]);
    }

    public function change_active(Singer $singer)
    {
        $result = $this->singerservice->change_active($singer);
        if ($result===false)
            return response()->json([
                'error'=> true,
                'active'=>$singer->active
            ]);
        else
            return response()->json([
                'error'=> false,
                'active'=>$singer->active,
                'id'=>$singer->id
            ]);
    }
}
