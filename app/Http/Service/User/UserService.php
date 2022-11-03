<?php

namespace App\Http\Service\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Events\Registered;
use phpDocumentor\Reflection\Types\True_;


class UserService
{
    public function create($request){
        $avatar = $request->input('avatar');
        if ($request->input('password')!=$request->input('confirm_password')){
            Session::flash('error','Mật khẩu xác nhận không đúng');
            return false;
        }elseif ($request->input('mailxacthuc')!=$request->input('xacthuc')){
            Session::flash('error','Mã xác thực không đúng, vui lòng kiểm tra lại email');
            return false;
        }elseif ($request->input('avatar')=='' || $request->input('avatar')==null){
            $avatar = '/storage/uploads/avatar_user/avatar_ntt.png';
        }
        try {
            User::create([
                'username'=>(string) $request->input('username'),
                'name'=>(string) $request->input('name'),
                'email'=>(string)$request->input('email'),
                'quyen'=>1,
                'password'=>(string)Hash::make($request->input('password')),
                'avatar'=>$avatar,
            ]);
            return true;
        }catch (\Exception $err){
            return false;
        }
    }


    public function login($request){
        try {
            $user = User::where('username',$request->input('email'))
                ->orWhere('email',$request->input('email'))
                ->first();
            if (password_verify($request->input('password'), $user->password)) {
                return true;
            } else {
                Session::flash('error', 'Username hoặc mật khẩu không đúng');
                return false;
            }
        }catch (\Exception $err) {
            Session::flash('error','Username hoặc mật khẩu không đúng');
            return false;
        }
    }

    public function getuser($user){
        $username = User::where('username',$user)
                    ->orWhere('email',$user)
                    ->first();
        if ($username===null){
            return false;
        }else{
            return $username;
        }
    }

    public function getuser_forget($username, $email){
        $username = User::where('username',$username)
            ->Where('email',$email)
            ->first();
        if ($username===null){
            Session::flash('error','Username hoặc email không đúng');
            return false;
        }else{
            return $username;
        }
    }

    public function getemail($email){
        $username =  User::where('email',$email)
                    ->first();
        if ($username===null){
            return false;
        }else{
            return $username;
        }
    }

    public function user_mana(){
        return User::where('quyen',1)->simplePaginate(10);
    }

    public function edit_username($id,$request){
        $user = User::where('id',$id)->first();
        $user->username = $request->input('username');
        $user->save();
        return $user;
    }

    public function edit_name($id,$request){
        $user = User::where('id',$id)->first();
        $user->name = $request->input('name');
        $user->save();
        return $user;
    }

    public function edit_pass($request,$id){
        $user = User::where('id',$id)->first();
        $pass = (string)Hash::make($request->input('password'));
        $user->password = $pass;
        $user->save();
        return true;
    }

    public function edit_avatar($id,$request){
        $user = User::where('id',$id)->first();
        $user->avatar = $request->input('avatar');
        $user->save();
        return true;
    }

}
