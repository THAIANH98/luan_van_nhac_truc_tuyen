@extends('main')
@section('head')
    <style>
        #listbaihat{
            overflow-y: scroll;
            scrollbar-color: #656262;
            scrollbar-width: thin;
            z-index: 1000;
            visibility: hidden;
            position: fixed;
            background: #0a0e14;
            height: 400px;
            opacity: 0.9;
            width: 300px;
            color: white;
            text-align: left;
            top:100px;
            right: 0px;
        }

        #namesong{
            margin-left: 50px;
        }

        #box_left_user {
            float: left;
            width: 200px;
            margin-right: 20px;
            padding: 20px 0px 20px 20px;
            margin: 0 0 20px 0;
            background: #e5e5e5;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
        }

        #box_left_user ul li {
            float: left;
            width: 100%;
            border-bottom: #d9d9d9 solid 1px;
        }
        #box_left_user ul li a {
            float: left;
            width: 190px;
            padding: 10px 0 10px 10px;
            font-size: 16px;
        }
        #box_left_user ul li a.active {
            background: #FFFFFF;
            color: #0689ba;
            font-weight: 700;
        }

        #box_left_user .box-img-avatar {
            float: left;
            width: 100%;
            border-bottom: #d9d9d9 solid 1px;
            padding: 0px 0px 20px 0px;
        }
    </style>
@endsection

@section('content')

    <div class="row">
        @include('user.sidebar')

        <div class="col-md-9 m-l-10">
            <h3  style="color: #0689ba;margin-bottom: 5%">Thông tin cá nhân</h3><br>
            <div class="row" style="line-height: 27px;">
                <div class="col-md-2" style="">
                    <span>Tên đăng nhập:</span>
                </div>
                <div class="col-md-10" style="display: flex;">
                    <span style="display:block;" id="username_h4">{{$user->username}}</span>
                    <input style="font-size:18px; display: none" id="username_edit" type="text" name="username" value="{{$user->username}}">
                    <span onclick="edit_username()" id="btn_edit_username" style="margin-left: auto;margin-right: 0">
                        <i class="fas fa-edit"></i>
                    </span>
                    <span onclick="save_username()" id="btn_save_username" style="margin-left: auto;margin-right: 0;display: none">
                          <i class="fas fa-save"></i>
                    </span>
                </div>
            </div><hr>

            <div class="row" style="line-height: 27px">
                <div class="col-md-2" style="">
                    <span>Tên tên hiển thị:</span>
                </div>
                <div class="col-md-10" style="display: flex;">
                <span style="display:block;" id="name_h4"> {{$user->name}}</span>
                <input style="font-size:18px; display: none" id="name_edit" type="text" name="name" value="{{$user->name}}">
                <span onclick="edit_name()"  id="btn_edit_name"  style="margin-left: auto;margin-right: 0">
                        <i class="fas fa-edit"></i>
                </span>
                <span onclick="save_name()" id="btn_save_name" style="margin-left: auto;margin-right: 0;display: none">
                      <i class="fas fa-save"></i>
                </span>
                </div>
            </div><hr>

            <div class="row" style="line-height: 27px">
                <div class="col-md-2" style="">
                    <span>Ảnh đại diện:</span>
                </div>
                <div class="col-md-10" style="display: flex;">
                    <input id="upload_avatar" name="upload_avatar" type="file" placeholder="">
                    <div style="margin-bottom: 10px" id="avatar_show">
                        <img src="{!! $user->avatar !!}" width="100px">
                    </div>
                    <input type="hidden" value="{!! $user->avatar !!}" name="avatar" id="avatar">
                    <span onclick="save_avatar()" id="btn_save_avatar" style="margin-left: auto;margin-right: 0;display: none">
                      <i class="fas fa-save"></i>
                    </span>
                </div>

            </div><hr>

            <div class="row" style="line-height: 27px">
                <div class="col-md-2" style="">
                    <span>Email:</span>
                </div>
                <div class="col-md-10" style="display: flex;">
                    <span>{{$user->email}}</span>
                </div>
            </div><hr>

            <div class="row" style="line-height: 27px">
                <div class="col-md-2" style="">
                    <span>Số bài hát:</span>
                </div>
                <div class="col-md-10" style="display: flex;">
                    <span>{{count($user->user_song)}}</span>
                </div>
            </div><hr>

            <div class="row" style="line-height: 27px">
                <div class="col-md-2" style="">
                    <span>Số playlist:</span>
                </div>
                <div class="col-md-10" style="display: flex;">
                    <span>{{ count($user->user_playlist)}}</span>
                </div>
            </div><hr>
            <a href="/edit_pass/{{$user->id}}">
                <button style="font-size: 16px;float: right" class="btn btn-primary">
                    Đổi mật khẩu
                </button>
            </a>
        </div>
    </div>
    <script>
        function edit_username(){
            document.getElementById('username_h4').style.display = 'none';
            document.getElementById('username_edit').style.display = 'block';
            document.getElementById('btn_save_username').style.display= 'block';
            document.getElementById('btn_edit_username').style.display= 'none';
        }

        function save_username(){
            document.getElementById('btn_save_username').style.display= 'none';
            document.getElementById('btn_edit_username').style.display= 'block';
            document.getElementById('username_h4').style.display = 'block';
            document.getElementById('username_edit').style.display = 'none';

            username=document.getElementById('username_edit').value;
            $.ajax({
                type: 'POST',
                datatype: 'JSON',
                data: {username},
                url: '/edit_username/{{$user->id}}',
                success:function (result){
                    if (result.error == false){
                        console.log(result.name)
                        document.getElementById('username_h4').innerHTML= result.name;
                    }
                }
            });
        }

        function edit_name(){
            document.getElementById('name_h4').style.display = 'none';
            document.getElementById('name_edit').style.display = 'block';
            document.getElementById('btn_save_name').style.display= 'block';
            document.getElementById('btn_edit_name').style.display= 'none';
        }

        function save_name(){
            document.getElementById('btn_save_name').style.display= 'none';
            document.getElementById('btn_edit_name').style.display= 'block';
            document.getElementById('name_h4').style.display = 'block';
            document.getElementById('name_edit').style.display = 'none';

            name=document.getElementById('name_edit').value;
            $.ajax({
                type: 'POST',
                datatype: 'JSON',
                data: {name},
                url: '/edit_name/{{$user->id}}',
                success:function (result){
                    if (result.error == false){
                        console.log(result.name)
                        document.getElementById('name_h4').innerHTML= result.name;
                        sessionStorage.setItem('nameuser',result.name);
                        document.getElementById('username').innerHTML='<b>'+sessionStorage.getItem('nameuser')+'</b>';
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
            document.getElementById('btn_save_avatar').style.display = 'block';

        });

        function save_avatar(){
            avatar = document.getElementById('avatar').value;
            sessionStorage.setItem('avatar',avatar);
            $.ajax({
                type: 'POST',
                datatype: 'JSON',
                data: { avatar },
                url: '/edit_avatar/{{$user->id}}',
                success:function (result){
                    if (result.error == false){
                        location.reload();
                    }
                }
            });
        }

    </script>
@endsection

@section('footer')


{{--    <script>--}}
{{--        function doitrangthai(id){--}}
{{--            if(document.getElementById("listbaihat").style.visibility == "hidden"){--}}
{{--                var url ='/admin/playlist/song/'+id;--}}
{{--                $.ajax({--}}
{{--                    type: 'GET',--}}
{{--                    datatype: 'JSON',--}}
{{--                    url: url,--}}
{{--                    success:function (result){--}}
{{--                        if (result.error == true){--}}
{{--                            var  html='';--}}
{{--                            $('#listbaihat').html(html);--}}
{{--                            alert('Hiện không có bài hát thể loại này');--}}
{{--                        }else {--}}
{{--                            console.log(result.song);--}}
{{--                            var  html='';--}}
{{--                            $.each(result.song, function (i,item){--}}
{{--                                html+='<label id="namesong">'+item.name+'</label><br>';--}}
{{--                                $('#listbaihat').html(html);--}}
{{--                            });--}}
{{--                        }--}}
{{--                    }});--}}
{{--                document.getElementById("listbaihat").style.visibility = "visible";--}}
{{--            }--}}
{{--            else--}}
{{--                document.getElementById("listbaihat").style.visibility = "hidden";--}}
{{--        };--}}

{{--    </script>--}}
@endsection
