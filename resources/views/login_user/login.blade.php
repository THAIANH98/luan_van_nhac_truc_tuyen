<script src="/template/vendor/jquery/jquery-3.2.1.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="/template/owlcarousel/owl.carousel.min.js"></script>
<link rel="stylesheet" href="/template/admin/dist/css/alt/adminlte.light.css">
<style>

    /*.modal.show .modal-dialog {*/
    /*    -webkit-transform: translate(0,0);*/
    /*    transform: translate(0,0);*/
    /*}*/

    /*.modal.fade .modal-dialog {*/
    /*    transition: -webkit-transform .3s ease-out;*/
    /*    transition: transform .3s ease-out;*/
    /*    transition: transform .3s ease-out,-webkit-transform .3s ease-out;*/
    /*    -webkit-transform: translate(0,-25%);*/
    /*    transform: translate(0,-25%);*/
    /*}*/

    .modal-lg {
        max-width: 1000px;
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
        font-size: 30px;
        font-family: inherit;
        font-weight: 500;
        color: #007efc;

    }

    .modal-title {
        margin-bottom: 0;
        line-height: 1.5;
    }

    button.close {
        padding: 0;
        background-color: transparent;
        border: 0;
        -webkit-appearance: none;
    }

    .input-field {
        width: 100%;
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

    .btn:not(:disabled):not(.disabled) {
        cursor: pointer;
    }

    .input-field button[type="submit"] {
        border-radius: 8px !important;
        background: #007efc;
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
            background: #e9544f;
    }

    .modal-dialog {
        max-width: 1000px;
        margin: 1.75rem auto;
    }

    .modal-lg {
        max-width: 800px;
    }
</style>

<div id="myModal_login" class="modal fade show" role="dialog" style="z-index: 2147483647; display: block; padding-right: 17px;">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content modal-login modal-form">
            <div class="modal-header">
                <span class="modal-title span_h5" style="margin: auto">Đăng nhập</span>
            </div>
            @include('admin.alert')

            <div class="modal-body">
                <div class="row">
                    <form id="form-login" method="post" style="width: 100%" >
                        <div style="display: block;float: left;width: 90%;margin-left: 5%;margin-right: 5%">
                            <div class="input-field">
                                <input type="text" id="username" class="email" name="email" placeholder="Tên đăng nhập">
                                <input type="password" id="password" class="password" name="password" placeholder="Mật khẩu">
                                <div class="login_action">
                                    <input onclick="show_pass()" type="checkbox" id="contact_csn" style="margin-right: 10px;line-height: 22px;font-size: 15px" value="">  Hiển thị mật khẩu
                                    <a href="/forget_pass" style=" margin-left: 15px; float:right; color: #888;">Quên mật khẩu?</a>
                                    <button class="btn btn-outline-success my-2 my-sm-0 waves-effect waves-light" type="submit">Đăng nhập</button>
                                </div>
                                <p class="text-p">Bạn chưa có tài khoản? <a href="/user/register/"style="margin-right: 15px;color: #007efc;">Đăng ký</a>
                                </p></div>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function show_pass(){
        if(document.getElementById('contact_csn').checked == true){
            document.getElementById('password').type = 'text';
        }else{
            document.getElementById('password').type = 'password';
        }
    }

    sessionStorage.removeItem('email');
    sessionStorage.removeItem('nameuser');
    sessionStorage.removeItem('id');
    sessionStorage.removeItem('avatar');

    document.querySelector('#username').addEventListener('change',sessionname);

    function sessionname(){
        var user = document.getElementById('username').value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            datatype: 'JSON',
            url: '/getusername/'+user,
            success: function (result){
                if(result.error===false){
                    var email = result.email;
                    var nameuser = result.nameuser;
                    var id = result.id;
                    var avatar = result.avatar;
                    sessionStorage.setItem('email',email);
                    sessionStorage.setItem('id',id);
                    sessionStorage.setItem('nameuser',nameuser);
                    sessionStorage.setItem('avatar',avatar);
                }
            }
        });
    }

</script>

<script src="/template/js/public.js"></script>
<script src="/template/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>

