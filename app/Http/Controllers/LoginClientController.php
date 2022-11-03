<?php

namespace App\Http\Controllers;

use App\Http\Service\User\UserService;
use App\Mail\xacthuc_email;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Testing\Fluent\Concerns\Has;

class LoginClientController extends Controller
{

    protected $userservice;

    public function __construct(UserService $userService)
    {
        $this->userservice = $userService;
    }

    public function login(){
        return view('login_user.login',[
           'title'=>'Đăng Nhập',
        ]);
    }

    public function register(){
        return view('login_user.register',[
           'title'=>'Đăng ký',
        ]);
    }

    public function register_store(Request $request){

        return redirect()->route('send_mail',[
            'name'=> $request->input('name'),
            'username'=> $request->input('username'),
            'email'=> $request->input('email'),
            'avatar'=>$request->input('avatar'),
        ]);
    }

    public function login_store(Request $request){
        if ($this->userservice->login($request)){
            return redirect('/');
        }else{
            return redirect()->back();
        }
    }

    public function getuser($user){
        $users = $this->userservice->getuser($user);
        if ($users===false)
            return response()->json([
                'error'=> true,
            ]);
        else
            return response()->json([
                'error'=> false,
                'id'=>$users->id,
                'nameuser'=>$users->name,
                'email'=>$users->email,
                'avatar'=>$users->avatar,
            ]);
    }

    public function getuser_indata($user){
        $users = $this->userservice->getuser($user);
        if ($users===false)
            return response()->json([
                'error'=> true,
            ]);
        else
            return response()->json([
                'error'=> false,
                'nameuser'=>$users->name,
                'email'=>$users->email
            ]);
    }

    public function getemail_indata($email){
        $users = $this->userservice->getemail($email);
        if ($users===false)
            return response()->json([
                'error'=> true,
            ]);
        else
            return response()->json([
                'error'=> false,
                'nameuser'=>$users->name,
                'email'=>$users->email
            ]);
    }
}
