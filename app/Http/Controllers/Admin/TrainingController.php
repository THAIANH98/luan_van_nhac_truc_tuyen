<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Service\Search\SearchFileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TrainingController extends Controller
{
    protected $train;

    public function __construct(SearchFileService $testService)
    {
        $this->train = $testService;
    }

    public function index(){
        $this->train->train();
//        Session::flash('success','Xây dựng thành công hệ thống tìm kiếm');
        return redirect('/admin/main');
    }
}
