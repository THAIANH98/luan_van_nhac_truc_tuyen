<?php

namespace App\Http\Controllers;

use App\Http\Service\User\UserService;
use App\Mail\mail_edit_pass;
use App\Mail\xacthuc_email;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use mysql_xdevapi\Exception;
use phpDocumentor\Reflection\Types\True_;

class SendMailController extends Controller
{

    protected $userservice;

    public function __construct(UserService $userService)
    {
        $this->userservice = $userService;
    }

    public function sendmail(Request $request){
        $ma_xacthuc = random_int(100000,999999);
        $mail = new xacthuc_email();
        $mail->ma_xacthuc = $ma_xacthuc;
        $mail->theloaimail = 'xacthuc';
        $mail->name_user = $request->input('name');
        Mail::to($request->input('email'))->send($mail);
        return view('login_user.xacthuc',[
            'title'=>'Xác thực Email',
            'name'=> $request->input('name'),
            'username'=> $request->input('username'),
            'email'=> $request->input('email'),
            'avatar'=>$request->input('avatar'),
            'mxt'=>$ma_xacthuc,
        ]);
    }

    public function create_user(Request $request){
        if($this->userservice->create($request)){
            return redirect('/user/login/');
        }else{
            return redirect()->back();
        }
    }

    public function edit_pass(User $user){
        $ma_xacthuc = random_int(100000,999999);
        $mail = new xacthuc_email();
        $mail->ma_xacthuc = $ma_xacthuc;
        $mail->theloaimail = 'doimatkhau';
        Mail::to($user->email)->send($mail);

        return view('login_user.doimatkhau',[
            'title'=>'Đổi mật khẩu',
            'mxt'=>$ma_xacthuc,
            'user'=>$user,
        ]);
    }

    public function store_pass(Request $request,User $user){

        if($this->userservice->edit_pass($request,$user->id)){
            return redirect('/user/login');
        }else{
            return redirect()->back();
        }
    }



//    Quên mật khẩu
    public function forget_pass(){
        return view('login_user.quenmatkhau',[
            'title'=>'Quên mật khẩu',
        ]);
    }

    public function store_forget_pass(Request $request){
        $user = $this->userservice->getuser_forget($request->input('username'),$request->input('email'));
        if($user) {
            return redirect()->route('send_mail_forget_pass',[
                'title' => 'Xác thực Email',
                'name' => $user->name,
                'username' => $user->username,
                'email' => $request->input('email'),
                'avatar'=>$user->avatar,
            ]);
        }else{
            return redirect()->back();
        }
    }

    public function sendmail_forget_pass(Request $request){
        $ma_xacthuc = random_int(100000,999999);
        $mail = new xacthuc_email();
        $mail->ma_xacthuc = $ma_xacthuc;
        $mail->theloaimail = 'doimatkhau';
        Mail::to($request->input('email'))->send($mail);
        return view('login_user.xacthuc',[
            'title'=>'Xác thực Email',
            'name'=> $request->input('name'),
            'username'=> $request->input('username'),
            'email'=> $request->input('email'),
            'avatar'=>$request->input('avatar'),
            'mxt'=>$ma_xacthuc,
        ]);
    }

    public function reset_pass(Request $request){
        $user = $this->userservice->getuser_forget($request->input('username'),$request->input('email'));
        if($this->userservice->edit_pass($request,$user->id)){
            return redirect('/user/login');
        }else{
            return redirect()->back();
        }
    }


}
