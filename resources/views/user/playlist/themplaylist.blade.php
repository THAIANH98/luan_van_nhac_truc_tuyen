@extends('main')

@section('head')
    <style>
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

        #box_right_user .box-edit-user-profile .input-group {
            padding: 15px 0;
            border-top: #f3f3f3 solid 1px;
            float: left;
            width: 878px;
        }

        #box_right_user .box-edit-user-profile .input-group label {
            display: inline-block;
            width: 170px;
            float: left;
            text-align: right;
            margin-right: 15px;
            margin-top: 6px;
            margin-bottom: 0px;
            color: #333;
            font-size: 14px;
            font-weight: 700;
        }

        .list_song_in_album {
            position: relative;
            height: 486px;
            border: #dbdbdb solid 1px;
        }
        .list_song_in_album .btn_search {
            position: absolute;
            right: 4px;
            top: 8px;
            display: block;
            width: 20px;
            height: 20px;
            background: url(https://stc-id.nixcdn.com/v11/images/icon-repeat.png) left -3149px no-repeat;
            cursor: pointer;
            border: 0 none;
        }

        textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {
            border: 1px solid #c7c7c7;
            color: #333333;
            font-size: 12px;
            padding: 5px 5px;
            text-indent: 6px;
            -webkit-appearance: none;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
            -webkit-transition: border .25s linear, color .25s linear;
            -moz-transition: border .25s linear, color .25s linear;
            -o-transition: border .25s linear, color .25s linear;
            transition: border .25s linear, color .25s linear;
            -webkit-backface-visibility: hidden;
        }

        ul.list_song_in_album {
            width: 838px;
            float: left;
            border: #dbdbdb solid 1px;
            margin-top: 0px;
        }

        .list_song_in_album {
            position: relative;
            height: 486px;
            border: #dbdbdb solid 1px;
        }

        .box-select-hero {
            float: left;
            width: 29px;
            height: 40px;
            background: url(https://stc-id.nixcdn.com/v11/images/icon-repeat.png) 9px -3105px no-repeat;
            margin: 130px 0 0 0;
        }

        .box-select-hero {
            float: left;
            width: 29px;
            height: 40px;
            background: url(https://stc-id.nixcdn.com/v11/images/icon-repeat.png) 9px -3105px no-repeat;
            margin: 130px 0 0 0;
        }
    </style>
@endsection

@section('content')

    <script>
        var nameuser = sessionStorage.getItem('nameuser');
        var email = sessionStorage.getItem('email');
        var id = sessionStorage.getItem('id');
        var avatar = sessionStorage.getItem('avatar');
        sessionStorage.clear();
        sessionStorage.setItem('nameuser',nameuser);
        sessionStorage.setItem('email',email);
        sessionStorage.setItem('id',id);
        sessionStorage.setItem('avatar',avatar);
    </script>
    <div class="row">
        @include('user.sidebar')

        <div class="col-md-9">
            @include('admin.alert')
            <h3 style="color: #0689ba;margin-bottom: 5%">Thêm Playlist</h3>

            <form method="post">
                <div class="box_right_upload form-row">
                    <div class="choose_music_search list_music"></div>

                    <div class="choose_album_search list_music">
                    </div>

                    <div class="form-group col-12">
                        <label for="music_title">Tên playlist<font color="red"> (*)</font></label>
                        <input type="text" class="form-control" id="name" value="" name="name" placeholder="Nhập tên playlist">
                    </div>

                    <div class="form-group col-6">
                        <label for="cat_id">Chuyên mục</label>
                        <select class="form-control" name="menu_id" id="menu_id">
                            @foreach($menus as $menu)
                                <option value="{{$menu->id}}">{{$menu->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="cat_level" style="opacity: 0;">csn</label>
                        <select class="form-control" name="category_id" id="category_id" >
                            @foreach($category as $cate)
                                <option value="{{$cate->id}}">{{$cate->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="menu">Hình ảnh</label>
                        <input type="file" id="upload_thumb_client"  style="padding: 5px" class="form-control">
                        <div id="thumb_show"></div>
                        <input type="hidden" name="thumb" id="thumb">
                    </div>

                    <div class="form-group col-12">
                        <div class="form-group">
                            <div class="form-inline">
                                <label for="exampleInputPassword1">Danh sách bài hát</label>
                            </div>
                            <div style="display: flex">
                                <input type="text" id="namesongx" autocomplete="on" style="width: 99%" placeholder="Nhập tên bài hát..." >
                                <a onclick="danhsach()" style="padding: 5px">
                                    <i class="fas fa-search"></i>
                                </a>
                            </div>

                            <div class="form-control pl-4 " style="   height: 200px;
                                                                  overflow-y: scroll;
                                                                  scrollbar-color: #656262;
                                                                  scrollbar-width: thin;" >
                                <ul id="danhsachbaihat">

                                </ul>
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-12">
                        <div class="form-group">
                            <div class="form-inline">
                                <label for="exampleInputPassword1">Bài hát được chọn</label>
                            </div>
                        </div>
                        <div class="form-control pl-4 " style=" width: 100%;min-height: 50px;height: auto">
                            <ul id="danhsachchon">

                            </ul>
                        </div>
                    </div>



                    <div class="text-center col-12">
                        <button type="submit" onclick="reloadpage()" id="btn-upload" class="btn btn-primary btn-upload">Tải lên</button>
                    </div>
                </div>
                @csrf
            </form>
        </div>
    </div>

@endsection

@section('footer')
    <script>
        $('#upload_thumb_client').change(function (){
            console.log('sadgasy')
            const form =new FormData();
            form.append('thumb',$(this)[0].files[0]);
            $.ajax({
                processData: false,
                contentType: false,
                type: 'POST',
                datatype: 'JSON',
                data:form,
                url: '/upload_playlist_user/services',
                success: function (results){
                    if(results.error == false){
                            $('#thumb_show').html('<a href=" ' + results.url + '" target="_blank">' +
                                '<img src="' + results.url + '" width="100px"></a>');
                            $('#thumb').val(results.url);
                    }else {
                        alert('Tải file bị lỗi');
                    }
                }
            })
        });

        function reloadpage(){
            var $iddel = document.getElementsByName('song_id[]');
            for($i=0 ; $i <$iddel.length;$i++){
                if($iddel[$i].checked===true){
                    console.log($iddel[$i]);
                    sessionStorage.removeItem($iddel[$i].value);
                }
            }
    }

        let i=0;
        function taoluutru(name,id){
        if (document.getElementById(name).checked===true) {
        sessionStorage.setItem(name, id)
        var ul = document.getElementById("danhsachchon");
        var li = document.createElement("li");
        var btn = document.createElement("button");
        var input = document.createElement('input');
        var hr = document.createElement('hr');
        li.appendChild(document.createTextNode(document.getElementById(sessionStorage.getItem(name)).value));
        li.setAttribute("id", 'song_id'+sessionStorage.getItem(name));
        btn.setAttribute("id", 'del_song_id'+sessionStorage.getItem(name));
        btn.setAttribute("class", 'btn btn-danger');
        btn.appendChild(document.createTextNode('Xóa'));
        input.setAttribute("name", 'song_id[]');
        input.setAttribute("id", 'song_input'+sessionStorage.getItem(name));
        li.appendChild(btn);
        li.appendChild(input);
        li.appendChild(hr);
        ul.appendChild(li);
        document.getElementById('song_input'+sessionStorage.getItem(name)).style.display = 'none';
        document.getElementById('song_input'+sessionStorage.getItem(name)).value = sessionStorage.getItem(name);
        document.getElementById('del_song_id'+sessionStorage.getItem(name)).style.right = 0;
        document.getElementById('del_song_id'+sessionStorage.getItem(name)).style.float = 'right';
        document.getElementById('del_song_id'+sessionStorage.getItem(name)).onclick = function (){removeli(sessionStorage.getItem(name))};
    }else {
        let li_rm = document.querySelector('#song_id'+sessionStorage.getItem(name))
        li_rm.remove();
        sessionStorage.removeItem(name);
    }
    };

        function removeli(song_id){
        let btn_rm =  document.querySelector('#del_song_id'+song_id);
        let li_rm = document.querySelector('#song_id'+song_id);
        btn_rm.remove();
        li_rm.remove();
        sessionStorage.removeItem(song_id);
        document.getElementById(song_id).checked=false;
    }
        var listname=[];
        var listid=[];

        $(document).ready(function() {
        $('#category_id').bind('change',
            function song_genre(){
                var idcate = document.getElementById('category_id').value;
                var idmenu = document.getElementById('menu_id').value;
                var url ='/list_genre';
                if (idcate!='*'){
                    url = url+'/'+idmenu+'/'+idcate;
                    $.ajax({
                        type: 'GET',
                        datatype: 'JSON',
                        url: url,
                        success:function (result){
                            if (result.error == true){
                                var  html='';
                                $('#danhsachbaihat').html(html);
                            }else {
                                console.log(result.songs);
                                var  html='';
                                listid.splice(0);
                                listname.splice(0);
                                $.each(result.songs, function (i,item){
                                    listname.push(item.name);
                                    listid.push(item.id);
                                    if(sessionStorage.getItem(item.id)==item.id)
                                        html +='<li style="display:flex"><input type="checkbox" checked=true onclick= taoluutru('+item.id +','+item.id +') style="width: 20px;height: 20px"  id="'+item.id+'" value="'+ item.name +'">';
                                    else
                                        html +='<li style="display:flex"><input type="checkbox" onclick= taoluutru('+item.id +','+item.id +') style="width: 20px;height: 20px" id="'+item.id+'" value="'+ item.name +'">';
                                    html +="<label class='form-check-label' for='"+ item.id +"'>";
                                    html +=" &ensp;"+ item.name+ "</label></li><br>";
                                });
                                $('#danhsachbaihat').html(html);
                            }
                        }
                    })
                }else {
                    url = '/list_menu_genre'+'/'+idmenu;
                    $.ajax({
                        // cache: false,
                        type: 'GET',
                        datatype: 'JSON',
                        // data: { id },
                        url: url,
                        success:function (result){
                            if (result.error == true){
                                var  html='';
                                $('#danhsachbaihat').html(html);
                            }else {
                                console.log(result.songs);
                                var  html='';
                                listid.splice(0);
                                listname.splice(0);
                                $.each(result.songs, function (i,item){
                                    listname.push(item.name);
                                    listid.push(item.id);
                                    if(sessionStorage.getItem(item.id)==item.id)
                                        html +='<li style="display:flex"><input type="checkbox"  checked=true onclick= taoluutru('+item.id +','+item.id +') style="width: 20px;height: 20px" id="'+item.id+'" value="'+ item.name +'">';
                                    else
                                        html +='<li style="display:flex"><input type="checkbox" onclick= taoluutru('+item.id +','+item.id +') style="width: 20px;height: 20px" id="'+item.id+'" value="'+ item.name +'">';
                                    html +="<label class='form-check-label' for='"+ item.id +"'>";
                                    html +=" &ensp;"+ item.name+ "</label></li><br>";
                                });
                                $('#danhsachbaihat').html(html);
                            }
                        }
                    })
                }
            }
        );
    });


    $(document).ready(function() {
    $('#menu_id').bind('change',
            function song_genre(){
                var idcate = document.getElementById('category_id').value;
                var idmenu = document.getElementById('menu_id').value;
                var url ='/list_genre';
                if (idcate!='*'){
                    url = url+'/'+idmenu+'/'+idcate;
                    $.ajax({
                        type: 'GET',
                        datatype: 'JSON',
                        url: url,
                        success:function (result){
                            if (result.error == true){
                                var  html='';
                                $('#danhsachbaihat').html(html);
                            }else {
                                console.log(result.songs);
                                var  html='';
                                listid.splice(0);
                                listname.splice(0);
                                $.each(result.songs, function (i,item){
                                    listname.push(item.name);
                                    listid.push(item.id);
                                    if(sessionStorage.getItem(item.id)==item.id)
                                        html +='<li style="display:flex"><input type="checkbox"  checked=true onclick= taoluutru('+item.id +','+item.id +') style="width: 20px;height: 20px" id="'+item.id+'" value="'+ item.name +'">';
                                    else
                                        html +='<li style="display:flex"><input type="checkbox" onclick= taoluutru('+item.id +','+item.id +') style="width: 20px;height: 20px" id="'+item.id+'" value="'+ item.name +'">';
                                    html +="<label class='form-check-label' for='"+ item.id +"'>";
                                    html +=" &ensp;"+ item.name+ "</label></li><br>";
                                });
                                $('#danhsachbaihat').html(html);
                            }
                        }
                    })
                }else {
                    url = '/list_menu_genre'+'/'+idmenu;
                    $.ajax({
                        // cache: false,
                        type: 'GET',
                        datatype: 'JSON',
                        // data: { id },
                        url: url,
                        success:function (result){
                            if (result.error == true){
                                var  html='';
                                $('#danhsachbaihat').html(html);
                            }else {
                                console.log(result.songs);
                                var  html='';
                                listid.splice(0);
                                listname.splice(0);
                                $.each(result.songs, function (i,item){
                                    listname.push(item.name);
                                    listid.push(item.id);
                                    if(sessionStorage.getItem(item.id)==item.id)
                                        html +='<li style="display:flex"><input type="checkbox"  checked=true onclick= taoluutru('+item.id +','+item.id +') style="width: 20px;height: 20px" id="'+item.id+'" value="'+ item.id +'">';
                                    else
                                        html +='<li style="display:flex"><input type="checkbox" onclick= taoluutru('+item.id +','+item.id +') style="width: 20px;height: 20px" id="'+item.id+'" value="'+ item.id +'">';
                                    html +="<label class='form-check-label' for='"+ item.id +"'>";
                                    html +=" &ensp;"+ item.name+ "</label></li><br>";
                                });
                                $('#danhsachbaihat').html(html);
                            }
                        }
                    })
                }
            }
        );
    });

        function danhsach(){
        $name = document.getElementById('namesongx').value;
        console.log($name);
        var arrinner=new Array();
        for(var i=0;i<listname.length;i++){
        if(listname[i].toLowerCase().indexOf($name.toLowerCase())=='-1'){
        continue;
    }
        arrinner[arrinner.length]=i;
    }
        var html='';
        for (i=0;i<arrinner.length;i++){
        if(sessionStorage.getItem(listid[arrinner[i]])==listid[arrinner[i]])
        html +='<li style="display:flex"><input type="checkbox" checked=true onclick= taoluutru('+listid[arrinner[i]]+','+listid[arrinner[i]]+') style="width: 20px;height: 20px"  id="'+listid[arrinner[i]]+'" value="'+ listname[arrinner[i]] +'">';
        else
        html +='<li style="display:flex"><input type="checkbox" onclick= taoluutru('+listid[arrinner[i]] +','+listid[arrinner[i]] +') style="width: 20px;height: 20px" id="'+listid[arrinner[i]]+'" value="'+ listname[arrinner[i]] +'">';
        html +="<label class='form-check-label' for='"+ listid[arrinner[i]]+"'>";
        html +=" &ensp;"+ listname[arrinner[i]]+ "</label></li><br>";
    }
        document.getElementById('danhsachbaihat').innerHTML=html;
    };

    </script>
@endsection
