<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Service\User\UserService;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userservice;

    public function __construct(UserService $userService)
    {
        $this->userservice = $userService;
    }

    public function index(){
        return view('admin.user.listuser',[
            'title'=>'Danh Sách Thành Viên',
            'users'=>$this->userservice->user_mana()
        ]);
    }

    public function detail(User $user){
        return view('admin.user.detail_user',[
           'title'=>'Chi Tiết Thành Viên: '.$user->name,
            'user'=>$user
        ]);
    }

}
