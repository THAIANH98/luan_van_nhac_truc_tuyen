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
<script src="/template/vendor/jquery/jquery-3.2.1.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="/template/owlcarousel/owl.carousel.min.js"></script>
<link rel="stylesheet" href="/template/admin/dist/css/alt/adminlte.light.css">
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
                    <form class="col-md-12" method="post">
                        <div style="display: table;float: left;width: 90%; margin-right: 5%;margin-left: 5%">
                            <div class="input-field">
                                <input class="username" id="username" name="username" type="text" placeholder="Tên đăng nhập">
                                <span style="color: red;display: none" id="loiusername">Tên đăng nhập đã tồn tại</span>
                                <input class="name" name="name" type="text" placeholder="Tên hiển thị">
                                <input class="email" id="email" name="email" type="email" placeholder="Địa chỉ email" required="Email">
                                <span style="color: red;display: none" id="loiemail">Email đã tồn tại</span>
                                <label style="color: #888">Hình Ảnh</label>
                                <input id="upload_avatar" name="upload_avatar" type="file" placeholder="">
                                <div style="margin-bottom: 10px" id="avatar_show"></div>
                                <input type="hidden" name="avatar" id="avatar">
                                <div class="login_action">
                                    <input class="contact_csn" type="checkbox" id="contact_csn" checked="" name="contact_csn">
                                    <label style="cursor: pointer; font-size: 13px; display: inline;" for="contact_csn"><a> Thỏa thuận sử dụng</a></label>
                                </div>
                                <button class="btn my-2 my-sm-0 waves-effect waves-light" style="margin-left: 0px;width: 100%; padding: 10px" type="submit">Xác thực Email</button>
                            </div>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector('#username').addEventListener('change',sessionname);
    document.querySelector('#email').addEventListener('change',sessionemail);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function sessionname(){
        var user = document.getElementById('username').value;
        $.ajax({
            type: 'POST',
            datatype: 'JSON',
            url: '/getusername_indata/'+user,
            success: function (result){
                if(result.error===false){
                    document.getElementById('loiusername').style.display = 'block';
                }else {
                    document.getElementById('loiusername').style.display = 'none';
                }
            }
        });
    }

    function sessionemail(){
        var email = document.getElementById('email').value;
        $.ajax({
            type: 'POST',
            datatype: 'JSON',
            url: '/getemail_indata/'+email,
            success: function (result){
                if(result.error===false){
                    document.getElementById('loiemail').style.display = 'block';
                }else {
                    document.getElementById('loiemail').style.display = 'none';
                }
            }
        });
    }

    $('#upload_avatar').change(function (){
        const form =new FormData();
        form.append('avatar',$(this)[0].files[0]);
        $.ajax({
            processData: false,
            contentType: false,
            type: 'POST',
            datatype: 'JSON',
            data:form,
            url: '/upload_avatar/services',
            success: function (results){
                if(results.error == false){
                    $('#avatar_show').html('<a href=" ' + results.url + '" target="_blank">' +
                                   '<img src="' + results.url + '" width="100px"></a>');
                    // $('#song_show').html('<audio controls href=" ' + results.url + '" target="_blank">' +
                    //     '<source src="' + results.url + '" type="audio/mpeg"></audio>');
                    $('#avatar').val(results.url);
                }else {
                    alert('Tải file bị lỗi');
                }
            }
        })
    });

</script>
