<?php

namespace App\Mail;

use App\Models\maxacthuc;
use http\Env\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class xacthuc_email extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     *
     */

    public $ma_xacthuc;
    public $name_user;
//    public $id_user;
    public $theloaimail;

    public function __construct()
    {

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->theloaimail=='doimatkhau'){
            return $this->view('mail.mail_edit_pass',[
                'maxacthuc'=>$this->ma_xacthuc,
//                'id_user'=>$this->id_user,
            ]);
        }
        elseif ($this->theloaimail=='xacthuc'){
            return $this->view('mail.xacthuc',[
                'maxacthuc'=>$this->ma_xacthuc,
                'nameuser'=>$this->name_user,
            ]);
        }
    }
}


