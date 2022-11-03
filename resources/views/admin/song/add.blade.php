@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="/template/admin/awesomplete/awesomplete.css" />
    <script src="/template/admin/awesomplete/awesomplete.js"></script>
@endsection

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-4 " >
                    <div class="form-group">
                        <label for="menu">Tên Bài Hát</label><font color="red"> (*)</font>
                        <input type="text" name="name" class="form-control" id="menu" placeholder="Enter name">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Danh Mục</label><font color="red"> (*)</font>
                        <select class="form-control" name="menu_id">
                            @foreach($menus as $menu)
                                <option value="{{$menu->id}}" >{{$menu->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Thể Loại</label><font color="red"> (*)</font>
                        <select class="form-control" name="category_id">
                            @foreach($category as $ctegory)
                                <option value="{{$ctegory->id}}" >{{$ctegory->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="menu">File Bài Hát</label><font color="red"> (*)</font>
                        <input type="file" id="upload_song"  style="padding: 5px" class="form-control">
                        <div id="song_show"></div>
                        <input type="hidden" name="file_song" id="file_song">
                    </div>

                    <div class="form-group">
                        <label for="menu">Hình Ảnh</label>
                        <input type="file" id="upload_thumb"  style="padding: 5px" class="form-control">
                        <div id="thumb_show"></div>
                        <input type="hidden" name="thumb" id="thumb">
                    </div>
                </div>

                <div class="form-group col-md-4">
{{--                    <div class="form-group">--}}
                        <label for="exampleInputPassword1">Nhạc Sĩ</label><font color="red"> (*)</font>
                    <br>
                    <input class="form-control" name="musican_name" style="width: 700px" id="myinput" />
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
                <div class="form-group col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Danh Sách Ca Sĩ</label><font color="red"> (*)</font><br>
                        <input type="text" class="form-control" id="namesinger" autocomplete="on" style="width: 90%" placeholder="Tìm ca sĩ..." >

                        <div class="form-control pl-4" id="listsinger" style="   width: 90%; height: 300px;
                                                                  overflow-y: scroll;
                                                                  scrollbar-color: #656262;
                                                                  scrollbar-width: thin;" >
                            @foreach($singers as $singer)
                                <input type="checkbox" for="{{$singer->id}}" name="singer_id[]" style="width: 20px;height: 20px; color: white" id="{{$singer->id}}" value="{{$singer->id}}">
                                <label class="form-check-label" for="{{$singer->id}}" > &ensp;{{$singer->name}}</label>
                                <br>
                            @endforeach
                        </div>

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
                                    textnode += '<input type="checkbox" for="'+listid[arrinner[i]]+'"  onclick="taoluutru('+listid[arrinner[i]]+','+listid[arrinner[i]]+')" checked name="singer_id[]" style="width: 20px;height: 20px; color: white" id="'+listid[arrinner[i]]+'" value="'+ listid[arrinner[i]] +'">' +
                                        '<label class="form-check-label"for="'+listid[arrinner[i]]+'" > &ensp;'+ listname[arrinner[i]] + '</label> </br>' ;
                                    else
                                        textnode += '<input type="checkbox" for="'+listid[arrinner[i]]+'"  onclick="taoluutru('+listid[arrinner[i]]+','+listid[arrinner[i]]+')"  name="singer_id[]" style="width: 20px;height: 20px; color: white" id="'+listid[arrinner[i]]+'" value="'+ listid[arrinner[i]] +'">' +
                                            '<label class="form-check-label" for="'+listid[arrinner[i]]+'"  > &ensp;'+ listname[arrinner[i]] + '</label> </br>';
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
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="menu">Lời Bài Hát</label>
                <textarea name="lyric" id="lyric" class="form-control" ></textarea>
            </div>

            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" name="active" checked id="active">
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" name="active" id="no_active">
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm Bài Hát</button>
        </div>
        @csrf
    </form>

@endsection


@section('footer')

    <script>
        CKEDITOR.replace('lyric')
    </script>
@endsection
