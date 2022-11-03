@extends('main')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
    <style>
        .form-row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -5px;
            margin-left: -5px;
        }

        .box_right_upload .form-group .form-control {
            opacity: 0.8;
            border: 1px solid rgba(151, 151, 151, 0.5);
            border-radius: 3px;
            font-size: 14px;
            color: #7c7b7b;
            letter-spacing: 0;
            font-family: 'SFProDisplay-Regular';
            min-height: 40px;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }

        .box_right_upload .form-group label {
            font-size: 16px;

            color: #1B1B1B;
            letter-spacing: 0;
            font-family: 'SFProDisplay-Bold';
        }

        .box_right_upload .form-group small {
            font-family: 'SFProDisplay-Regular';
            color: #FF2D55;
            letter-spacing: 0;
            font-size: 12px;
        }
        ul.token-input-list-facebook {
            overflow: hidden;
            height: auto !important;
            border: 1px solid #d3d3d3;
            cursor: text;
            font-size: 14px;
            min-height: 1px;
            z-index: 999;
            margin: 0;
            padding: 4px 8px;
            background-color: #fff;
            list-style-type: none;
            clear: left;
            min-height: 40px;
            font-family: 'SFProDisplay-Regular';
        }

        ul.token-input-list-facebook li input {
            border: 0;
            width: 100px;
            padding: 3px 8px;
            background-color: white;
            margin: 1px 0;
            -webkit-appearance: caret;
            color: #7c7b7b;
        }

        li.token-input-token-facebook {
            overflow: hidden;
            height: auto !important;
            height: 15px;
            margin: 1px 3px;
            padding: 3px 8px;
            background-color: #fc5975;
            color: white;
            cursor: default;
            border: 1px solid #fc5975;
            font-size: 13.6px;
            border-radius: 5px;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            float: left;
            white-space: nowrap;
        }
        li.input-token-none-facebook {
            background-color: #959595!important;
            border: 1px solid #959595!important;
        }

        li.token-input-token-facebook p {
            display: inline;
            padding: 0;
            margin: 0;
        }

        li.token-input-token-facebook span {
            color: white;
            margin-left: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        li.token-input-selected-token-facebook {
            background-color: #fc5975;
            border: 1px solid #f84d6a;
            color: #fff;
        }

        li.token-input-input-token-facebook {
            float: left;
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        div.token-input-dropdown-facebook {
            position: absolute;
            width: 400px;
            background-color: #fff;
            overflow: hidden;
            border-left: 1px solid #ccc;
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            cursor: default;
            font-size: 11px;
            font-family: Verdana;
            z-index: 1;
        }

        div.token-input-dropdown-facebook p {
            margin: 0;
            padding: 5px;
            font-weight: bold;
            color: #777;
        }

        div.token-input-dropdown-facebook ul {
            margin: 0;
            padding: 0;
        }

        div.token-input-dropdown-facebook ul li {
            background-color: #fff;
            padding: 3px;
            margin: 0;
            list-style-type: none;
        }

        div.token-input-dropdown-facebook ul li.token-input-dropdown-item-facebook {
            background-color: #fff;
        }

        div.token-input-dropdown-facebook ul li.token-input-dropdown-item2-facebook {
            background-color: #fff;
        }

        div.token-input-dropdown-facebook ul li em {
            font-weight: bold;
            font-style: normal;
        }

        div.token-input-dropdown-facebook ul li.token-input-selected-dropdown-item-facebook {
            background-color: #fc5975;
            color: #fff;
        }

        .box_right_upload .form-group .form-control {
            opacity: 0.8;
            border: 1px solid rgba(151, 151, 151, 0.5);
            border-radius: 3px;
            font-size: 14px;
            color: #878787;
            letter-spacing: 0;
            font-family: 'SFProDisplay-Regular';
            min-height: 40px;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
    </style>
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
    </style>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h3 style="color: #0689ba;margin-bottom: 5%">Sửa Bài Hát</h3>
            <form method="post">
                <div class="box_right_upload form-row">
                    <div class="form-group col-12">
                        <label for="music_title">Tên bài hát <font color="red"> (*)</font></label>
                        <input type="text" class="form-control" id="name" value="{{$song->name}}" name="name" placeholder="Nhập tên bài hát">
                    </div>
                    <div class="form-group col-12">
                        <label for="music_artist">Nhạc Sĩ</label>
                        <input name="musican_name" class="form-control col-12" style="width: 870px" value="{{$song->song_musican->name}}" id="myinput" placeholder="Nhập tên nhạc sĩ" />
                    </div>

                    <script>
                        var input = document.getElementById("myinput");
                        var input = document.getElementById("myinput");
                        var awesomplete = new Awesomplete(input);
                        awesomplete.list=[
                            @foreach($musicans as $musican)
                                "{{$musican->name}}",
                            @endforeach
                        ];
                    </script>

                    <div class="form-group music_artist col-12">
                        <label for="music_artist">Ca sĩ<font color="red"> (*)</font></label>
                        <input type="text" id="namesinger" class="form-control" autocomplete="on" style="width: 100%;" placeholder="Tìm ca sĩ..." >
                        <div class="form-control pl-4" id="listsinger" style="   width: 100%; height: 300px;
                                                              overflow-y: scroll;
                                                              scrollbar-color: #656262;
                                                              scrollbar-width: thin;" >
                            <ul>
                                @foreach($singers as $singer)
                                    <li style="display: flex">
                                    @foreach($song->song_singer as $singerid)
                                        @if($singerid->id !== null)
                                            <input type="checkbox" {{ $singer->id==$singerid->id ? 'checked=true':'' }}
                                        @endif
                                    @endforeach
                                        <input type="checkbox"        for="{{$singer->id}}" name="singer_id[]" style="width: 20px;height: 20px; color: white" id="{{$singer->id}}" value="{{$singer->id}}">

                                        <label class="form-check-label" for="{{$singer->id}}" >&ensp; {{$singer->name}}</label>
                                    </li>
                                    <br>
                                @endforeach

                            </ul>
                        </div>


                    </div>
                    <div class="form-group col-6">
                        <label for="cat_id">Chuyên mục</label>
                        <select class="form-control" name="menu_id" id="menu_id">
                            @foreach($menus as $menu)
                                <option {{ $song->menu_id == $menu->id ? 'selected' : '' }} value="{{$menu->id}}">{{$menu->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="cat_level" style="opacity: 0;">csn</label>
                        <select class="form-control" name="category_id" id="category_id" >
                            @foreach($category as $cate)
                                <option {{ $song->category_id == $cate->id ? 'selected' : '' }} value="{{$cate->id}}">{{$cate->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-12">
                        <label for="menu">File Bài Hát <font color="red"> (*)</font></label>
                        <input type="file" id="upload_song_user"  style="padding: 5px" class="form-control">
                        <div id="song_show">
                            <audio controls>
                                <source src="{{$song->file_song}}">
                            </audio>
                        </div>
                        <input type="hidden" value="{{$song->file_song}}" name="file_song" id="file_song">
                    </div>

                    <div class="form-group col-12">
                        <label for="music_lyric">Lời bài hát</label>
                        <textarea class="form-control" name="lyric" id="lyric" rows="9">{!! $song->lyric !!}</textarea>
                    </div>

                    <div class="text-center col-12">
                        <button type="submit" id="btn-upload" class="btn btn-primary btn-upload">Cập nhật</button>
                    </div>
                </div>
                @csrf
            </form>
        </div>
    </div>


@endsection

@section('footer')
    <script>
        var listname=[
            @foreach($singers as $singer)
                '{{$singer->name}}',
            @endforeach
        ];
        var listid=[
            @foreach($singers as $singer)
                '{{$singer->id}}',
            @endforeach
        ];

        @foreach($singers as $singer)
        sessionStorage.removeItem("{{$singer->id}}");
        document.getElementById("{{$singer->id}}").onclick = function (e) {
            if (this.checked) {
                sessionStorage.setItem("{{$singer->id}}","{{$singer->name}}");
            } else {
                sessionStorage.removeItem("{{$singer->id}}");
            }
        }
        @endforeach

        document.querySelector('#namesinger').addEventListener('change',danhsach);

        function danhsach(){
            $name = document.getElementById('namesinger').value;
            console.log($name);
            var arrinner=new Array();
            for(var i=0;i<listname.length;i++){
                if(listname[i].toLowerCase().indexOf($name.toLowerCase())=='-1'){
                    continue;
                }
                arrinner[arrinner.length]=i;
            }
            var textnode='';
            for (i=0;i<arrinner.length;i++){
                if(sessionStorage.getItem(listid[arrinner[i]])==listid[arrinner[i]])
                    textnode += ' <li style="display: flex"> <input type="checkbox" for="'+listid[arrinner[i]]+'"  onclick="taoluutru('+listid[arrinner[i]]+','+listid[arrinner[i]]+')" checked name="singer_id[]" style="width: 20px;height: 20px; color: white" id="'+listid[arrinner[i]]+'" value="'+ listid[arrinner[i]] +'">' +
                        '<label class="form-check-label"for="'+listid[arrinner[i]]+'" > &ensp;'+ listname[arrinner[i]] + '</label></li> </br>' ;
                else
                    textnode += '<li style="display: flex"><input type="checkbox" for="'+listid[arrinner[i]]+'"  onclick="taoluutru('+listid[arrinner[i]]+','+listid[arrinner[i]]+')"  name="singer_id[]" style="width: 20px;height: 20px; color: white" id="'+listid[arrinner[i]]+'" value="'+ listid[arrinner[i]] +'">' +
                        '<label class="form-check-label" for="'+listid[arrinner[i]]+'"  > &ensp;'+ listname[arrinner[i]] + '</label></li> </br>';
            }
            document.getElementById('listsinger').innerHTML=textnode;
        };

        function taoluutru(name,id){
            if (document.getElementById(name).checked===true) {
                sessionStorage.setItem(name, id);
                // alert(sessionStorage.getItem(name));
            }else {
                sessionStorage.removeItem(name);
            }
        };
    </script>

    <script>
        CKEDITOR.replace('lyric')
        //upload filesong
        $('#upload_song_user').change(function (){
            console.log('sadgasy')
            const form =new FormData();
            form.append('file_song',$(this)[0].files[0]);
            $.ajax({
                processData: false,
                contentType: false,
                type: 'POST',
                datatype: 'JSON',
                data:form,
                url: '/upload_song_user/services',
                success: function (results){
                    if(results.error == false){
                        $('#song_show').html('<audio controls href=" ' + results.url + '" target="_blank">' +
                            '<source src="' + results.url + '" type="audio/mpeg"></audio>');
                        $('#file_song').val(results.url);
                    }else {
                        alert('Tải file bị lỗi');
                    }
                }
            })
        });
    </script>
@endsection
