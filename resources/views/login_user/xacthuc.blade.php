@include('head')
<style>
    .modal-lg {
        max-width: 800px;
    }

    .modal-content {
        font-family: 'SFProDisplay-Regular';
    }

    .modal-content {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        width: 100%;
        pointer-events: auto;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0,0,0,.2);
        border-radius: .3rem;
        outline: 0;
    }

    .modal-header {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: start;
        align-items: flex-start;
        -ms-flex-pack: justify;
        justify-content: space-between;
        padding: 1rem;
        border-bottom: 1px solid #e9ecef;
        border-top-left-radius: .3rem;
        border-top-right-radius: .3rem;
    }

    .span_h5 {
        font-size: 1.25rem;
        font-family: inherit;
        font-weight: 500;
        color: inherit;
    }

    .modal-title {
        margin-bottom: 0;
        line-height: 1.5;
    }

    .close:not(:disabled):not(.disabled) {
        cursor: pointer;
    }

    .modal-header .close {
        padding: 1rem;
        margin: -1rem -1rem -1rem auto;
    }

    button.close {
        padding: 0;
        background-color: transparent;
        border: 0;
        -webkit-appearance: none;
    }

    .close {
        float: right;
        font-size: 1.5rem;
        font-weight: 700;
        line-height: 1;
        color: #000;
        text-shadow: 0 1px 0 #fff;
        opacity: .5;
    }

    .input-field {
        width: 80%;
        margin: 0 auto;
        padding-bottom: 30px;
    }

    .input-field input[type="email"], .input-field input[type="password"], .input-field input[type="text"] {
        border: none;
        border-radius: 8px;
        margin: 6px 0;
        padding: 12px;
        transition: all 0.15s ease-in-out 0s;
        width: 100%;
        background-color: #d0d0d0;
        height: 42px;
        font-weight: bold;
    }

    .input-field input[type="email"], .input-field input[type="password"], .input-field input[type="text"] {
        border: none;
        border-radius: 8px;
        margin: 6px 0;
        padding: 12px;
        transition: all 0.15s ease-in-out 0s;
        width: 100%;
        background-color: #d0d0d0;
        height: 42px;
        font-weight: bold;
    }


    .input-field label{
        border: none;
        border-radius: 8px;
        margin: 6px 0;
        padding: 12px;
        transition: all 0.15s ease-in-out 0s;
        width: 100%;
        background-color: #d0d0d0;
        height: 42px;
        font-weight: bold;
    }



    .btn:not(:disabled):not(.disabled) {
        cursor: pointer;
    }

    .input-field button[type="submit"] {
        border-radius: 8px !important;
        background: #007efc;;
        background-color: rgb(0, 126, 252);
        background-image: none;
        border: medium none;
        width: 100%;
        color: #fff;
        cursor: pointer;
        margin: 10px 0;
        margin-top: 10px;
        margin-bottom: 10px;
        outline: medium none;
        overflow: hidden;
        padding: 10px;
        text-transform: uppercase;
        transition: all 0.15s ease-in-out 0s;
        margin-top: 7px !important;
        background-image: linear-gradient(-243deg, rgba(0, 139, 252, 0.83) 0%, rgba(0, 126, 252, 0.84) 100%);
        border-radius: 69px;
        color: #fff !important;
        border: none;
        border-top-color: currentcolor;
        border-right-color: currentcolor;
        border-bottom-color: currentcolor;
        border-left-color: currentcolor;
        min-width: 125px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        color: #FFFFFF;
        letter-spacing: 0;
        font-family: 'SFProDisplay-Bold';
        min-height: 38px;
        transition: all 0.2s linear;
    }

    .text-p {
        font-size: 14px;
        text-align: center;
        margin: 10px 0;
        color: #888;
    }

    .social_button {
        display: table;
        border-left: 1px solid #d0d0d0;
        padding-top: 15px;
        padding-bottom: 20px;
        padding-left: 0px;
    }

    .social {
        display: block;
        margin: 0 auto;
        overflow: hidden;
        width: 82%;
    }

    .social ul {
        display: block;
    }

    .social ul li {
        list-style: none;
        float: left;
        width: 100%;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .social ul li a {
        display: inline-block;
        font-size: 24px;
        text-decoration: none;
        color: #fff;
        padding: 6px;
        display: block;
        text-align: center;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 6px;
        -moz-transition: all 0.4s ease-in-out;
        -o-transition: all 0.4s ease-in-out;
        -webkit-transition: all 0.4s ease-in-out;
        transition: all 0.4s ease-in-out;
    }

    .social ul li a.facebook {
        background: #3a589a;
    }

    .social ul li a:hover {
        opacity: .8;
    }

    .social ul li a.google-plus {
        background: #007efc;
    }

    .modal-dialog {
        max-width: 500px;
        margin: 1.75rem auto;
    }

    .modal-lg {
        max-width: 800px;
    }
</style>


<div id="myModal_register" class="modal fade show" role="dialog" style="z-index: 999999; display: block; padding-right: 17px;">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content modal-register modal-form">
            <div class="modal-header">
                <span class="modal-title span_h5" style="float: left;">Đăng ký tài khoản</span>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            @include('admin.alert')
            <div class="modal-body">
                <div class="panel-body">
                    <form class="col-md-12" method="post" href="/">
                        <div style="display: table;float: left;width: 90%; margin-right: 5%;margin-left: 5%">
                            <div class="input-field">
                                <label style="font-size: 15px"> Tên đăng nhập: {{$username}} </label>
                                <input class="username" name="username" type="hidden" value="{{$username}}" placeholder="Tên đăng nhập">

                                <label style="font-size: 15px"> Tên hiển thị: {{$name}}</label>
                                <input class="name" name="name" type="hidden" value="{{$name}}" placeholder="Tên hiển thị">

                                <label style="font-size: 15px"> Email: {{$email}} </label>
                                <input class="email" name="email" type="hidden" value="{{$email}}" placeholder="Địa chỉ email" required="email">

                                <input class="password" id="password" name="password" type="password" placeholder="Mật khẩu">
                                <input class="confirm_password" id="confirm_password" name="confirm_password" type="password" placeholder="Xác nhận lại mật khẩu">
                                <input name="xacthuc" id="xacthuc" type="text" placeholder="Nhập mã xác thực Email">
                                <input value="{{$mxt}}" id="mxt" name="mailxacthuc" type="hidden">
                                <div style="display: flex">
                                    <input onclick="show_pass()" type="checkbox" id="contact_csn" style="margin-right: 10px;line-height: 22px;font-size: 15px" value="">  Hiển thị mật khẩu
                                </div>
                                <button class="btn my-2 my-sm-0 waves-effect waves-light" style="margin-left: 0px;width: 100%; padding: 10px" type="submit">Xác thực</button>
                                <script>
                                    function show_pass(){
                                        if(document.getElementById('contact_csn').checked == true){
                                            document.getElementById('password').type = 'text';
                                            document.getElementById('confirm_password').type  = 'text';
                                        }else{
                                            document.getElementById('password').type = 'password';
                                            document.getElementById('confirm_password').type  = 'password';
                                        }
                                    }
                                    sessionStorage.removeItem('user');

                                    document.querySelector('#xacthuc').addEventListener('change',sessionname);

                                    function sessionname(){
                                        if (document.getElementById('xacthuc').value==document.getElementById('mxt').value){
                                            sessionStorage.setItem('email','{{$email}}');
                                            sessionStorage.setItem('nameuser','{{$name}}');
                                            {{--sessionStorage.setItem('id','{{$email}}');--}}
                                            sessionStorage.setItem('avatar','{{$avatar}}');
                                        }
                                    }
                                </script>
                            </div>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/template/js/public.js"></script>
<script src="/template/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
