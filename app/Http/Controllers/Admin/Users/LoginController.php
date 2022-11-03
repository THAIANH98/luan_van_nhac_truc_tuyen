<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    public function index(){
        return view('admin.user.login',[
            'title'=>'Đăng Nhập'
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'username'=>'required',
            'password'=>'required',
        ]);

        $user = User::where('name',$request->input('username'))->first();
        if ($user->quyen!=0){
            Session::flash('error','Bạn không có quyền truy cập');
            return redirect()->back();
        }else{
            if(Auth::attempt([
                'name'=>$request->input('username'),
                'password'=>$request->input('password'),
            ],$request->input('remember'))) {
                return redirect()->route('admin');
            }
        }
        Session::flash('error','Username hoặc Password không đúng');
        return redirect()->back();
    }

    public function logout(){
        Auth::logout();
        return redirect('/admin/users/login');
    }
}
