@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-4 " >
                    <label for="menu">Tên Playlist</label><font color="red"> (*)</font>
                    <input type="text" name="name" class="form-control" id="menu" placeholder="Enter name" value="{{ $playlist->name }}">

                    <div class="form-group">
                        <label for="menu">Hình Ảnh</label>
                        <input type="file" id="upload_thumb"  style="padding: 5px" class="form-control">
                        <div id="thumb_show">
                            <img src="{!! $playlist->thumb !!}" width="100px">
                        </div>
                        <input type="hidden" name="thumb" value="{{ $playlist->thumb }}" id="thumb">
                    </div>

                    <div class="form-group">
                        <label>Kích hoạt</label>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" value="1" type="radio" name="active" {{ $playlist->active == 1 ? 'checked' : '' }} id="active">
                            <label for="active" class="custom-control-label">Có</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" value="0" type="radio" name="active" {{ $playlist->active == 0 ? 'checked' : '' }} id="no_active">
                            <label for="no_active" class="custom-control-label">Không</label>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Danh Mục</label>
                        <select class="form-control" name="menu_id" id="menu_id" >
                            @foreach($menus as $menu)
                                <option {{ $menu->id==$playlist->menu_id ? 'selected':'' }} value="{{$menu->id}}">{{$menu->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <div class="form-group">
                        <div class="form-inline">
                            <label for="exampleInputPassword1">Danh Sách Bài Hát</label>
                            <select class="form-control" style="margin-left: 20px" name="category_id" id="category_id">
                            <option value="*" selected >Tất cả</option>
                                @foreach($category as $ctegory)
                                    <option {{$ctegory->id==$playlist->category_id ? 'selected':''}} value="{{$ctegory->id}}">{{$ctegory->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-control pl-4 " id="danhsachbaihat" style="   height: 200px;
                                                                  overflow-y: scroll;
                                                                  scrollbar-color: #656262;
                                                                  scrollbar-width: thin;" >
                            @foreach($songs as $song)
                                @if($song->category_id == $playlist->category_id && $song->menu_id == $playlist->menu_id)
                                @foreach($playlist->playlist_song as $songid)
                                    <input type="checkbox" name="song_id[]"  id="{{$song->id}}" onclick="taoluutru('{{$song->id}}','{{$song->id}}')" style="width: 20px;height: 20px"
                                           {{ $song->id == $songid->id ? 'checked=true':'' }}
                                           @endforeach id="{{ $song->name }}" value="{{ $song->id }}">
                                    <label class="form-check-label" for="{{ $song->id }}">
                                        {{ $song->name }}
                                    </label>
                                    <br>
                                @endif
                                @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <script>
                @foreach($songs as $song)
                    sessionStorage.removeItem("{{$song->id}}","{{$song->id}}");
                @endforeach

                @foreach($songs as $song)
                    @foreach($playlist->playlist_song as $songid)
                        @if($song->id == $songid->id)
                            sessionStorage.setItem("{{$song->id}}","{{$song->id}}");
                        @endif
                    @endforeach
                @endforeach

                function taoluutru(name,id){
                    if (document.getElementById(name).checked===true) {
                        sessionStorage.setItem(name, id);
                    }else {
                        sessionStorage.removeItem(name);
                    }
                };
            </script>

            <div class="form-group">
                <label for="menu">Mô tả chi tiết</label>
                <textarea name="description" id="description" class="form-control" >{{ $playlist->description }}</textarea>
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập Nhật Playlist</button>
        </div>
        @csrf
    </form>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#category_id').bind('change',
                function song_genre(){
                    var idcate = document.getElementById('category_id').value;
                    var idmenu = document.getElementById('menu_id').value;
                    var url ='/admin/song/list_genre';
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
                                    $.each(result.songs, function (i,item){
                                        if(sessionStorage.getItem(item.id)==item.id)
                                            html +="<input type='checkbox' checked=true name='song_id[]' onclick='taoluutru("+item.id +","+item.id +")' id='"+item.id+"' style='width: 20px;height: 20px' id='"+ item.name.split("'").join('') +"'value='"+ item.id +"'>";
                                        else
                                            html +="<input type='checkbox' name='song_id[]' onclick='taoluutru("+item.id +","+item.id +")' id='"+item.id+"' style='width: 20px;height: 20px' id='"+ item.name.split("'").join('') +"'value='"+ item.id +"'>";
                                        html +="<label class='form-check-label' for='"+ item.id +"'>";
                                        html +=item.name+ "</label><br>";
                                    });
                                    $('#danhsachbaihat').html(html);
                                }
                            }
                        })
                    }else {
                        url = '/admin/song/list_menu_genre'+'/'+idmenu;
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
                                    $.each(result.songs, function (i,item){
                                    if(sessionStorage.getItem(item.id)==item.id)
                                        html +="<input type='checkbox' checked=true name='song_id[]' onclick='taoluutru("+item.id +","+item.id +")' id='"+item.id+"' style='width: 20px;height: 20px' id='"+ item.name.split("'").join('') +"'value='"+ item.id +"'>";
                                    else
                                        html +="<input type='checkbox' name='song_id[]' onclick='taoluutru("+item.id +","+item.id +")' id='"+item.id+"' style='width: 20px;height: 20px' id='"+ item.name.split("'").join('') +"'value='"+ item.id +"'>";

                                        html +="<label class='form-check-label' for='"+ item.id +"'>";
                                        html +="</label>"+item.name+"<br>";
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
                    var url ='/admin/song/list_genre';
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
                                    $.each(result.songs, function (i,item){
                                        if(sessionStorage.getItem(item.id)==item.id)
                                            html +="<input type='checkbox' checked=true name='song_id[]' onclick='taoluutru("+item.id +","+item.id +")' id='"+item.id+"' style='width: 20px;height: 20px' id='"+ item.name.split("'").join('') +"'value='"+ item.id +"'>";
                                        else
                                            html +="<input type='checkbox' name='song_id[]' onclick='taoluutru("+item.id +","+item.id +")' id='"+item.id+"' style='width: 20px;height: 20px' id='"+ item.name.split("'").join('') +"'value='"+ item.id +"'>";

                                        html +="<label class='form-check-label' for='"+ item.id +"'>";
                                        html +=item.name+ "</label><br>";
                                    });
                                    $('#danhsachbaihat').html(html);
                                }
                            }
                        })
                    }else {
                        url = '/admin/song/list_menu_genre'+'/'+idmenu;
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
                                    $.each(result.songs, function (i,item){
                                        if(sessionStorage.getItem(item.id)==item.id)
                                            html +="<input type='checkbox' checked=true name='song_id[]' onclick='taoluutru("+item.id +","+item.id +")' id='"+item.id+"' style='width: 20px;height: 20px' id='"+ item.name.split("'").join('') +"'value='"+ item.id +"'>";
                                        else
                                            html +="<input type='checkbox' name='song_id[]' onclick='taoluutru("+item.id +","+item.id +")' id='"+item.id+"' style='width: 20px;height: 20px' id='"+ item.name.split("'").join('') +"'value='"+ item.id +"'>";
                                        html +="<label class='form-check-label' for='"+ item.id +"'>";
                                        html +="</label>"+item.name+"<br>";
                                    });
                                    $('#danhsachbaihat').html(html);
                                }
                            }
                        })
                    }
                }
            );
        });

    </script>

@endsection


@section('footer')
    <script>
        CKEDITOR.replace('description')
    </script>
@endsection
